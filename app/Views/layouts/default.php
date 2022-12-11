<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title><?= $page_title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <?php if (isset($_SESSION['messages'])) : ?>
    <div id="messages" style="position:absolute;width:100%;top:0;">
      <?php foreach ($_SESSION['messages'] as $message) : ?>
        <?php if ($message['type'] == 'error') : ?>
          <div class="alert alert-danger">
            <?= $message['content'] ?>
          </div>
        <?php elseif ($message['type'] = 'success') : ?>
          <div class="alert alert-success">
            <?= $message['content'] ?>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  <?php endif ?>
  <?= $this->renderSection('content') ?>
  <script>
    const messages = document.getElementById('messages');
    if (messages) {
      setTimeout(() => {
        messages.remove()
      }, 5000);
    }
    const invalid_fields = document.querySelectorAll('.is-invalid');
    if (invalid_fields) {
      setTimeout(() => {
        document.querySelectorAll('.invalid-feedback').forEach((div) => {
          div.remove();
        });
      }, 5000);
    }
  </script>
</body>

</html>
