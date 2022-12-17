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

  public function validate_form(array $form_data, string $form_type): ?array
  {
    $this->reset();
    # rules and error messages => /Config/Validation.php
    $this->validation->run($form_data, $form_type);
    $this->errors = $this->validation->getErrors();
    if (!empty($this->errors)) {
      $_SESSION['validation_errors'] = $this->errors;
      $this->session->markAsFlashdata('validation_errors');
      return $this->errors;
    }
    return null;
  }

  public function get_errors(): array
  {
    return $this->errors;
  }
}
