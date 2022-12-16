<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Entities\User;

use App\Libraries\Auth;
use App\Libraries\Messenger;
use App\Libraries\Validator;

class Registration extends BaseController
{

  private $session;

  private $auth;
  private $messenger;
  private $my_validator;

  public function __construct()
  {

    $this->session = \Config\Services::session();

    $this->auth = new Auth(UserModel::class, User::class);
    $this->messenger = new Messenger($this->session);
    $this->my_validator = new Validator($this->session);
  }

  public function registration()
  {
    $user_model = new UserModel();
    $data['page_title'] = 'Registration Page';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $user = $this->auth->authenticate();
      if ($user) return redirect()->to('/');
      return view('registration', $data);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!$this->my_validator->validate_form($_POST, 'registration')) return redirect()->back()->withInput();
      if (!$user_model->create_user($_POST)) {
        foreach ($user_model->get_errors() as $error) {
          $this->messenger->set_message('error', $error);
        }
      } else {
        $this->messenger->set_message('success', 'Usuário criado com sucesso.');
        return redirect()->to('/login');
      }
      return redirect()->back();
    }
  }
}
