<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{

  private $session;
  private $messenger;
  private $my_validator;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    # pass session obj by reference to Validator and Messenger classes
    $this->messenger = new \App\Libraries\Messenger($this->session);
    $this->my_validator = new \App\Libraries\Validator($this->session);
  }

  private function authenticate()
  {
    if (isset($_SESSION['user_id'])) return 1;
    return 0;
  }

  private function user_exists(string $username)
  {
    $user_model = new User();
    if ($user_model->where('username', $username)->first() || $user_model->where('email', $username)->first()) return 1;
    return 0;
  }

  private function logout()
  {
    $this->session->destroy();
  }

  private function login()
  {
    if (user_exists($_POST['username'])) {

      $_SESSION['user_id'] = $user_id;
      return 1;
    }
    $this->messenger->set_message('error', 'Não foi possível realizar o login. Por favor, verifique o nome de usuário e a senha.');
    return 0;
  }

  private function create_user()
  {
    return 1;
  }

  public function login_page()
  {
    $data['page_title'] = 'Login Page';
    $method = $this->request->getMethod();
    if ($method == 'get') {
      # check logged in cookie
      if ($this->authenticate()) return view('home', ['page_title' => 'Home page']);
      return view('auth/login', $data);
    } elseif ($method == 'post') {
      if (!$this->my_validator->validate_form('login')) return redirect()->back()->withInput();
      $this->login();
      return redirect()->back();
    }
  }

  public function registration_page()
  {
    $data['page_title'] = 'Registration Page';
    $method = strtolower($this->request->getMethod());
    if ($method == 'get') {
      return view('auth/registration', $data);
    } elseif ($method == 'post') {
      if (!$this->my_validator->validate_form('registration')) return redirect()->back()->withInput();
      $this->create_user();
      return redirect()->back();
    }
  }
}
