<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Auth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $session = \Config\Services::session();
    if (!(new \App\Libraries\Auth(UserModel::class))->authenticate()) return redirect()->to('/login');;
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
