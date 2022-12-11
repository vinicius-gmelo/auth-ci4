  <div class='container'>
    <div class='row h-100'>
      <div class="col-md-4 offset-4 my-auto">
        <h4>Login</h4>
        <hr>
        <form class='form' action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <?php
          foreach ($fields as $field) : ?>
            <div class="form-group mb-3">
              <label for="<?= $field['name'] ?>"><?= ucfirst($field['value']) ?></label>
              <?php if (isset($_SESSION['validation_errors'][$field['name']])) : ?>
                <input type="<?= $field['type'] ?>" class='form-control is-invalid' id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" value="<?= old($field['name']) ?>" placeholder="<?= ucfirst($field['placeholder']) ?>">
                <div class="invalid-feedback">
                  <?= $_SESSION['validation_errors'][$field['name']] ?>
                </div>
              <?php else : ?>
                <input type="<?= $field['type'] ?>" class="form-control" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" value="<?= old($field['name']) ?>" placeholder="<?= ucfirst($field['placeholder']) ?>">
              <?php endif ?>
            </div>
          <?php endforeach ?>
          <div class="form-group mb-3">
            <input type="submit" class='btn btn-info' value='Login'>
          </div>
        </form>
        <p>Ainda não possui uma conta? <a href="<?= base_url('auth/cadastro') ?>">Cadastre-se</a>.</p>
      </div>
    </div>
  </div>
