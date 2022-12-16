<?php
echo $this->extend('layouts/default');
echo $this->section('content');
include PARTIALS_PATH . 'registration_form.php';
echo $this->endSection();
