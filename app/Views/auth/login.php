<?php
echo $this->extend('layouts/default');
echo $this->section('content');
include  __DIR__ . "/../partials/login_form.php";
echo $this->endSection();
