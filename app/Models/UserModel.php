<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
  protected $table      = 'user';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'email', 'password', 'username', 'session_id'];
  protected $returnType = User::class;

  protected $validationRules = [
    'name' => 'required',
    'email'        => 'required|valid_email|is_unique[user.email]',
    'password'     => 'required',
    'username'     => 'permit_empty|alpha_numeric_space|min_length[6]|max_length[30]|is_unique[user.username]',
    'session_id' => 'permit_empty',
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
