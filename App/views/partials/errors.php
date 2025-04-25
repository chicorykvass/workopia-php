<?php if (isset($errors)) : ?>
  <div class="mb-3">
    <?php foreach ($errors as $error) : ?>
      <div class="message text-red-950 bg-red-100 my-2 px-3 py-1">
        <?= $error ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
