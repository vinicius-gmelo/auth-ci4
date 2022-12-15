<?php
echo $this->extend('layouts/default');
echo $this->section('content');
helper('get_greeting');
$greeting = get_greeting();
?>
<nav class="navbar navbar-expand-md" style="border-bottom: 1px black solid;">
  <div class="container-fluid">
    <span><?= ucfirst($greeting) ?>, <?= $user['name'] ?></span>
    <a class="nav-link" href="<?= base_url('auth/logout') ?>" style="text-decoration: underline;">Sair</a>
  </div>
</nav>
<?= $this->endSection() ?>
