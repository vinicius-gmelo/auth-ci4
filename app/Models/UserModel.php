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

  public function create_user(array $data): bool
  {
    $data = array_intersect_key($data, array_flip(array('name', 'email', 'password', 'username')));
    $user = new User($data);
    if (!$this->save($user)) {
      return 0;
    }
    return 1;
  }

  public function user_exists(string $username): bool
  {
    if ($this->where('username', $username)->first() || $this->where('email', $username)->first()) return 1;
    return 0;
  }
}
