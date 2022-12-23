<div class='container'>
  <div class='row' style='height:100vh;'>
    <div class="col-md-8 offset-2 my-auto">
      <h4>Cadastro</h4>
      <hr>
      <form class='form' action='/cadastro' method="post" novalidate>
        <?= csrf_field() ?>

        <div class="form-group mb-3">
          <label for='name'>Nome:</label>
          <?php if (isset($_SESSION['validation_errors']['name'])) : ?>
            <input type='text' class='form-control is-invalid' id='name' name='name' value="<?= old('name') ?>" placeholder='Seu nome'>
            <div class="invalid-feedback">
              <?= $_SESSION['validation_errors']['name'] ?>
            </div>
          <?php else : ?>
            <input type='text' class="form-control" id='name' name='name' value="<?= old('name') ?>" placeholder='Seu nome'>
          <?php endif ?>
        </div>

        <div class="form-group mb-3">
          <label for='email'>Email:</label>
          <?php if (isset($_SESSION['validation_errors']['email'])) : ?>
            <input type='email' class='form-control is-invalid' id='email' name='email' value="<?= old('email') ?>" placeholder='Seu email'>
            <div class="invalid-feedback">
              <?= $_SESSION['validation_errors']['email'] ?>
            </div>
          <?php else : ?>
            <input type='email' class="form-control" id='email' name='email' value="<?= old('email') ?>" placeholder='Seu email'>
          <?php endif ?>
        </div>

        <div class="form-group mb-3">
          <label for='password'>Senha:</label>
          <?php if (isset($_SESSION['validation_errors']['password'])) : ?>
            <input type='password' class='form-control is-invalid' id='password' name='password' value="<?= old('password') ?>" placeholder='Sua senha'>
            <div class="invalid-feedback">
              <?= $_SESSION['validation_errors']['password'] ?>
            </div>
          <?php else : ?>
            <input type='password' class="form-control" id='password' name='password' value="<?= old('password') ?>" placeholder='Sua senha'>
          <?php endif ?>
        </div>

        <div class="form-group mb-3">
          <label for='password_conf'>Senha:</label>
          <?php if (isset($_SESSION['validation_errors']['password_conf'])) : ?>
            <input type='password' class='form-control is-invalid' id='password_conf' name='password_conf' value="<?= old('password_conf') ?>" placeholder='Confirme sua senha'>
            <div class="invalid-feedback">
              <?= $_SESSION['validation_errors']['password_conf'] ?>
            </div>
          <?php else : ?>
            <input type='password' class="form-control" id='password_conf' name='password_conf' value="<?= old('password_conf') ?>" placeholder='Confirme sua senha'>
          <?php endif ?>
        </div>

        <div class="form-group mb-3">
          <input type="submit" class='btn btn-primary' value='Enviar'>
        </div>

      </form>

      <p>Já possui uma conta? Faça o <a href="<?= base_url('login') ?>">login</a>.</p>

    </div>
  </div>
</div>
