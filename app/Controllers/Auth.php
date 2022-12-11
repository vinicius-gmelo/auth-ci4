<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Auth extends BaseController
{

  private $session;
  private $validation;
  private $validation_errors;
  private $messages;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->validation = Services::validation();
    $this->validation_errors = null;
    $this->messages = null;
  }

  private function validate_form(string $form)
  {
    $this->validation->reset();
    # rules and error messages => /Config/Validation.php
    $this->validation->run($_POST, $form);
    $errors = $this->validation->getErrors();
    if (!empty($errors)) {
      $this->validation_errors = $errors;
    }
  }

  private function set_message(string $type, string $content)
  {
    $this->messages[] = ['type' => $type, 'content' => $content];
    $_SESSION['messages'] = $this->messages;
    $this->session->markAsFlashdata('messages');
  }

  private function authenticate()
  {
    if (isset($_SESSION['user_id'])) return 1;
    return 0;
  }

  private function login()
  {
    if ($_POST['username'] === 'vini' && $_POST['password'] === '12345') {
      $_SESSION['user_id'] = '1';
      $this->session->markAsTempdata('user_id', 60);
      return 1;
    }
    $this->set_message('error', 'Não foi possível realizar o login. Por favor, cheque o nome de usuário e a senha.');
    return 0;
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
      $this->validate_form('login');
      if (!is_null($this->validation_errors)) {
        $_SESSION['validation_errors'] = $this->validation_errors;
        $this->session->markAsFlashdata('validation_errors');
        return redirect()->back()->withInput();
      }
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
      $this->validate_form('registration');
      if (!is_null($this->validation_errors)) {
        $_SESSION['validation_errors'] = $this->validation_errors;
        $this->session->markAsFlashdata('validation_errors');
        return redirect()->back()->withInput();
      }
      # register => models, DB
      return redirect()->back();
    }
  }
}
