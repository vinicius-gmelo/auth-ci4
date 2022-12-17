<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Entities\User;
use App\Libraries\Auth;

class AuthController extends BaseController
{

  private $session;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    if (!(new Auth(UserModel::class, User::class))->authenticate()) return redirect()->to('/login');
  }
}
