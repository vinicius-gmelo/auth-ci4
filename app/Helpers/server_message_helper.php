<?php

use App\Controllers\BaseController;

function set_message(BaseController $controller, string $type, string $content)
{
  $controller->messages[] = ['type' => $type, 'content' => $content];
  $_SESSION['messages'] = $controller->messages;
  $controller->session->markAsFlashdata('messages');
}
