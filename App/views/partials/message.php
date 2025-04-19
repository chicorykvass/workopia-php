<?php if (isset($_SESSION['success_message'])) : ?>
  <div class="message text-green-900 bg-green-100 p-3 my-3">
    <?= $_SESSION['success_message'] ?>
  </div>
  <?php unset($_SESSION['success_message']); ?>
<?php elseif (isset($_SESSION['success_message'])) : ?>
  <div class="message text-red-950 bg-red-100 p-3 my-3">
    <?= $_SESSION['error_message'] ?>
  </div>
  <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
