<?php

namespace App\Libraries;

use Config\Services;

class Validator
{

  private $validation;
  private ?array $errors;
  private $session;

  public function __construct(&$session)
  {
    $this->validation = Services::validation();
    $this->errors = null;
    $this->session = $session;
  }

  private function reset()
  {
    $this->validation->reset();
    $this->errors = null;
  }

  public function validate_form(string $form): bool
  {
    $this->reset();
    # rules and error messages => /Config/Validation.php
    $this->validation->run($_POST, $form);
    $this->errors = $this->validation->getErrors();
    if (!empty($this->errors)) {
      $_SESSION['validation_errors'] = $this->errors;
      $this->session->markAsFlashdata('validation_errors');
      return 0;
    }
    return 1;
  }

  public function get_errors(): array
  {
    return $this->errors;
  }
}
