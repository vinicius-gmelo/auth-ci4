<?php
echo $this->extend('layouts/default');
echo $this->section('content');

# form fields
foreach (['username' => ['nome de usuário/e-mail', 'seu nome de usuário', 'text',], 'password' => ['senha', 'sua senha', 'password',],] as $field_name => $attr_arr) {
  $fields[$field_name] = ['name' => $field_name, 'value' => $attr_arr[0], 'placeholder' => $attr_arr[1], 'type' => $attr_arr[2]];
}

# using PHP's include because CI4 partials/$this->include() does not support passing data
include  __DIR__ . "/../partials/login_form.php";

echo $this->endSection();
