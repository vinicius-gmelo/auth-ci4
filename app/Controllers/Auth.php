<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{

  private $session;
  private $messenger;
  private $my_validator;
  private $user_model;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    # pass session obj by reference to Validator and Messenger classes
    $this->messenger = new \App\Libraries\Messenger($this->session);
    $this->my_validator = new \App\Libraries\Validator($this->session);
  }

  private function authenticate(): bool
  {
    if (isset($_SESSION['user_id'])) {
      $this->user_model = new User();
      if ($user_model->find($_SESSION['user_id'])) {
        $user = $userModel->find($_SESSION['user_id']);
        if ($user['session_id'] == $this->session->session_id) return 1;
      }
    }
    return 0;
  }

  private function user_exists(string $username): bool
  {
    $this->user_model = new User();
    if ($user_model->where('username', $username)->first() || $user_model->where('email', $username)->first()) return 1;
    return 0;
  }

  private function logout()
  {
    $this->user_model = new User();
    $user = $user_model->find($_SESSION['user_id']);
    unset($user['session_id']);
    $user_model->update($user['id'], $user);
    $this->session->destroy();
  }

  private function login(): bool
  {
    $this->user_model = new User();
    if ($this->user_exists($_POST['username'])) {
      $user = $user_model->where('username', $username)->first() ?? $user_model->where('email', $username)->first();
      if (!$user['password'] == $_POST['password']) return 0;
      $user->set(['session_id' => $this->session->session_id])->update();
      $_SESSION['user_id'] = $user['id'];
      return 1;
    }
    return 0;
  }

  private function create_user()
  {
    $data = [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'password' => $_POST['password']
    ];
    if (!empty($_POST['username'])) $data['username'] = $_POST['username'];
    $this->user_model = new User();
    if (!$user_model->insert($data, false)) return 0;
    $_SESSION['user_id'] = $user_model->getInsertID();
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
      if (!$this->login()) $this->messenger->set_message('error', 'Verifique o nome de usuário e a senha.');
      return redirect()->back();
    }
  }

  public function registration_page()
  {
    $data['page_title'] = 'Registration Page';
    $method = strtolower($this->request->getMethod());
    if ($method == 'get') {
      if (isset($_SESSION['user_id'])) redirect()->to('/auth');
      return view('auth/registration', $data);
    } elseif ($method == 'post') {
      if (!$this->my_validator->validate_form('registration')) return redirect()->back()->withInput();
      if (!$this->create_user()) {
        # setup messenger with user model's errors
        foreach ($this->user->errors() as $error) {
          $this->messenger->set_message('error', $error);
        }
      }
      return redirect()->back();
    }
  }
}
