<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

  public function index()
  {
    # redirects to login page
    return redirect()->to('/auth');
  }
}
