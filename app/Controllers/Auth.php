<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Auth extends BaseController
{

  private $session;
  private $validation;
  private $validation_errors;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->validation = Services::validation();
  }

  private function validate_form(string $form_name)
  {
    $this->validation->reset();
    $this->validation_errors = null;
    # rules and error messages => /Config/Validation.php
    $this->validation->run($_POST, $form_name);
    $errors = $this->validation->getErrors();
    if (!empty($errors)) {
      $this->validation_errors = $errors;
    }
  }

  public function login()
  {
    $data['title'] = 'Login Page';
    $method = $this->request->getMethod();
    if ($method == 'get') {
      return view('auth/login', $data);
    } elseif ($method == 'post') {
      $this->validate_form('login');
      if (!is_null($this->validation_errors)) {
        $_SESSION['validation_errors'] = $this->validation_errors;
        $this->session->markAsFlashdata('validation_errors');
        # redirect to avoid resubmit form data on user refresh
        return redirect()->back()->withInput();
      }
      # login => models, DB
      return redirect()->back();
    }
  }

  public function register()
  {
    $data['title'] = 'Registration Page';
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
      return redirect()->back();
    }
  }
}
