<?php http_response_code($status); ?>
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-slate-600 text-center text-8xl mb-4 font-bold border border-gray-300 pb-7 pt-5"><?= $status ?></div>
    <p class="text-slate-500 text-center font-semibold text-4xl">
      <?= $message ?>
    </p>
  </div>
</section>

<?= loadPartial('footer') ?>
