<?php

namespace App\Libraries;

class Messenger
{

  private $session;
  private $messages;

  public function __construct(&$session)
  {
    $this->session = $session;
  }

  public function set_message(string $type, string $content)
  {
    $this->messages[] = ['type' => $type, 'content' => $content];
    $_SESSION['messages'] = $this->messages;
    $this->session->markAsFlashdata('messages');
  }

  public function get_messages(): ?array
  {
    return $this->messages;
  }
}
