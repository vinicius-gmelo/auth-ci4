<div class='container'>
  <div class='row' style='height:100vh;'>
    <div class="col-md-8 offset-2 my-auto">
      <h4>Login</h4>
      <hr>
      <form class='form' action="/login" method="post" novalidate>
        <?= csrf_field() ?>

        <div class="form-group mb-3">
          <label for='username'>Nome de usuário/email:</label>
          <?php if (isset($_SESSION['validation_errors']['username'])) : ?>
            <input type='text' class='form-control is-invalid' id='username' name='username' value="<?= old('username') ?>" placeholder='Seu nome de usuário'>
            <div class="invalid-feedback">
              <?= $_SESSION['validation_errors']['username'] ?>
            </div>
          <?php else : ?>
            <input type='text' class="form-control" id='username' name='username' value="<?= old('username') ?>" placeholder='Seu nome de usuário'>
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
          <input type="submit" class='btn btn-primary' value='Login'>
        </div>

      </form>

      <p>Ainda não possui uma conta? <a href="<?= base_url('/cadastro') ?>">Cadastre-se</a>.</p>

    </div>
  </div>
</div>
