<?php

namespace App\Libraries;

class Auth
{

  private $user_model;
  private $user_entity;
  private array $errors;

  public function __construct($user_model, $user_entity)
  {
    $this->user_model = $user_model;
    $this->user_entity = $user_entity;
  }

  public function authenticate()
  {
    $user_model = new $this->user_model();
    $user = $user_model->where('session_id', session_id())->first();
    if ($user) return $user;
    return 0;
  }

  private function user_exists(string $username): bool
  {
    $user_model = new $this->user_model();
    if ($user_model->where('username', $username)->first() || $user_model->where('email', $username)->first()) return 1;
    return 0;
  }

  public function logout(): void
  {
    $user_model = new $this->user_model();
    $user = $user_model->where('session_id', session_id())->first();
    $user->session_id = null;
    $user_model->save($user);
    session_destroy();
  }

  public function login(array $data): bool
  {
    $user_model = new $this->user_model();
    $username = $data['username'];
    $password = $data['password'];
    if ($this->user_exists($username)) {
      $user = $user_model->where('username', $username)->first() ?? $user_model->where('email', $username)->first();
      if (!password_verify($password, $user->password)) return 0;
      $user->session_id = session_id();
      $user_model->save($user);
      return 1;
    }
    return 0;
  }

  public function create_user(array $data): bool
  {
    $user_model = new $this->user_model();
    $data = array_intersect_key($data, array_flip(array('name', 'email', 'password', 'username')));
    $user = new $this->user_entity($data);
    if (!$user_model->save($user)) {
      $this->errors = $user_model->errors();
      return 0;
    }
    return 1;
  }

  public function get_errors(): array
  {
    return $this->errors;
  }
}
