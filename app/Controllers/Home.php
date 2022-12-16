<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Entities\User;
use App\Libraries\Messenger;

class Home extends BaseController
{

  private $session;
  private $auth;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->auth = new \App\Libraries\Auth(UserModel::class, User::class);
  }

  public function index()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $user = $this->auth->authenticate();
      if ($user) return view('home', ['page_title' => 'Home page', 'user' => $user->toArray()]);
      return redirect()->to('/login');
    }
  }
}
