<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Entities\User;

class Auth extends BaseController
{

  private $session;

  private $auth;
  private $messenger;
  private $my_validator;

  public function __construct()
  {

    $this->session = \Config\Services::session();

    $this->auth = new \App\Libraries\Auth(UserModel::class, User::class);
    $this->messenger = new \App\Libraries\Messenger($this->session);
    $this->my_validator = new \App\Libraries\Validator($this->session);
  }

  public function login()
  {
    $data['page_title'] = 'Login Page';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      # check logged in cookie
      $user = $this->auth->authenticate();
      if ($user) return view('home', ['page_title' => 'Home page', 'user' => $user->toArray()]);
      return view('auth/login', $data);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!$this->my_validator->validate_form($_POST, 'login')) return redirect()->back()->withInput();
      if (!$this->auth->login($_POST)) {
        $this->messenger->set_message('error', 'Verifique o nome de usuário e a senha.');
        return redirect()->back()->withInput();
      }
      return redirect()->back();
    }
  }

  public function registration()
  {
    $data['page_title'] = 'Registration Page';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->auth->authenticate()) redirect()->to('/auth');
      return view('auth/registration', $data);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!$this->my_validator->validate_form($_POST, 'registration')) return redirect()->back()->withInput();
      if (!$this->auth->create_user($_POST)) {
        foreach ($this->auth->get_errors() as $error) {
          $this->messenger->set_message('error', $error);
        }
      } else {
        $this->messenger->set_message('success', 'Usuário criado com sucesso.');
        return redirect()->to('/auth');
      }
      return redirect()->back();
    }
  }


  public function logout()
  {
    $this->auth->logout();
    return redirect()->back();
  }
}
