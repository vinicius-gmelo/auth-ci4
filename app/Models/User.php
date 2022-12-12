<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  protected $table      = 'user';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'email', 'password', 'username'];

  protected $validationRules = [
    'name' => 'required',
    'email'        => 'required|valid_email|is_unique[user.email]',
    'password'     => 'required|min_length[5]|max_length[20]',
    'username'     => 'alpha_numeric_space|min_length[6]|max_length[30]|is_unique[user.username]',
  ];
  protected $validationMessages = [
    'email' => [
      'is_unique' => 'Email já utilizado por outro usuário.',
    ],
    'username' => [
      'is_unique' => 'Nome de usuário já utilizado.',
    ],
  ];
}
