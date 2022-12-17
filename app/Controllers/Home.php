<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\Auth;

class Home extends BaseController
{

  private $session;
  private $user;

  public function __construct()
  {

    $this->session = \Config\Services::session();
    $this->user = (new Auth(UserModel::class))->authenticate();
  }

  public function index()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') return view('home', ['page_title' => 'Home page', 'user' => $this->user->toArray()]);
  }
}
