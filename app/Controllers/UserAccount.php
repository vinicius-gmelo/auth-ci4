<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\{Messenger, Validator};

class UserAccount extends BaseController
{

  private $session;
  private $auth;
  private $messenger;
  private $my_validator;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->auth = new \App\Libraries\Auth(UserModel::class);
    $this->messenger = new Messenger($this->session);
    $this->my_validator = new Validator($this->session);
  }

  public function login()
  {
    $data['page_title'] = 'Login Page';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $user = $this->auth->authenticate();
      if ($user) return redirect()->to('/');
      return view('login', $data);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->my_validator->validate_form($_POST, 'login')) return redirect()->back()->withInput();
      if (!$this->auth->login($_POST)) {
        $this->messenger->set_message('error', 'Verifique o nome de usuário e a senha.');
        return redirect()->back()->withInput();
      }
      return redirect()->back();
    }
  }

  public function logout()
  {
    $this->auth->logout();
    return redirect()->back();
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
      if ($this->my_validator->validate_form($_POST, 'registration')) return redirect()->back()->withInput();
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
