<?php
echo $this->extend('layouts/default');
echo $this->section('content');
include  __DIR__ . "/../partials/registration_form.php";
echo $this->endSection();
