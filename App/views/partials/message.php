<?php

use Framework\Session; ?>
<?php if ($message = Session::getFlashMessage('success_message')) : ?>
  <div class="message text-green-900 bg-green-100 p-3 my-3">
    <?= $message ?>
  </div>
<?php elseif ($message = Session::getFlashMessage('error_message')) : ?>
  <div class="message text-red-950 bg-red-100 p-3 my-3">
    <?= $message ?>
  </div>
<?php endif; ?>
