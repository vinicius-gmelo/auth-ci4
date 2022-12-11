<?php
echo $this->extend('layouts/default');
echo $this->section('content')
?>
<p>User logged in (: </p>
<?= $this->endSection() ?>
