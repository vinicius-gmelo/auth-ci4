<?php

namespace App\Libraries;

class Auth
{

  private $user_model;

  public function __construct($user_model)
  {
    $this->user_model = $user_model;
  }

  public function authenticate(): ?object
  {
    $user_model = new $this->user_model();
    $user = $user_model->where('session_id', session_id())->first();
    if ($user) return $user;
    return null;
  }

  public function logout(): void
  {
    $user_model = new $this->user_model();
    $user = $user_model->where('session_id', session_id())->first();
    $user->session_id = null;
    $user_model->save($user);
    session_destroy();
  }

  public function login(array $data): ?object
  {
    $user_model = new $this->user_model();
    $username = $data['username'];
    $password = $data['password'];
    if ($user_model->user_exists($username)) {
      $user = $user_model->where('username', $username)->first() ?? $user_model->where('email', $username)->first();
      if (!password_verify($password, $user->password)) return 0;
      $user->session_id = session_id();
      $user_model->save($user);
      return $user;
    }
    return null;
  }
}
