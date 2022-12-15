<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
  // --------------------------------------------------------------------
  // Setup
  // --------------------------------------------------------------------

  /**
   * Stores the classes that contain the
   * rules that are available.
   *
   * @var string[]
   */
  public $ruleSets = [
    Rules::class,
    FormatRules::class,
    FileRules::class,
    CreditCardRules::class,
  ];

  /**
   * Specifies the views that are used to display the
   * errors.
   *
   * @var array<string, string>
   */
  public $templates = [
    'list'   => 'CodeIgniter\Validation\Views\list',
    'single' => 'CodeIgniter\Validation\Views\single',
  ];

  // --------------------------------------------------------------------
  // Rules
  // --------------------------------------------------------------------

  public $registration = ['name' => 'required', 'username' => 'permit_empty|alpha_numeric_space|min_length[6]|max_length[30]', 'email' => 'required|valid_email', 'password' => 'required|min_length[5]|max_length[20]', 'password_conf' => 'required|matches[password]'];

  public $login = ['username' => 'required', 'password' => 'required'];

  public $registration_errors = [
    'name' => [
      'required' => 'Preencha com um nome.',
    ],
    'username' => [
      'alpha_numeric_space' => 'Apenas caracteres alfanuméricos e espaços.',
      'min_length' => 'Mínimo de 6 caracteres.',
      'max_length' => 'Máximo de 30 caracteres.',
    ],
    'email' => [
      'required' => 'Preencha com um email.',
      'valid_email' => 'Email não é válido.'
    ],
    'password' => [
      'required' => 'Preencha com uma senha.',
      'min_length' => 'Mínimo de 5 caracteres.',
      'max_length' => 'Máximo de 20 caracteres.',
    ],
    'password_conf' => [
      'required' => 'Confirme sua senha.',
      'matches' => 'Não é igual à senha inserida.'
    ],
  ];

  public $login_errors = [
    'username' => [
      'required' => 'Preencha com seu nome de usuário/email.',
    ],
    'password' => [
      'required' => 'Preencha com sua senha.',
    ],
  ];
}
