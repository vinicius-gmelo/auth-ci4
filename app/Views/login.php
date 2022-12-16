<?php
echo $this->extend('layouts/default');
echo $this->section('content');
include  PARTIALS_PATH . 'login_form.php';
echo $this->endSection();
