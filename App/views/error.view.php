<?php http_response_code($status); ?>
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<section>
  <div class="container mx-auto p-4 mt-4">
    <?php if (preg_match('/\/listing\//', $_SERVER['REQUEST_URI'])) : ?>
      <a class="block p-4 text-blue-700" href="/listings">
        <i class="fa fa-arrow-alt-circle-left"></i>
        Back To Listings
      </a>
    <?php endif; ?>
    <div class="text-slate-600 text-center text-8xl mb-4 font-bold border border-gray-300 pb-7 pt-5"><?= $status ?></div>
    <p class="text-slate-500 text-center font-semibold text-4xl">
      <?= $message ?>
    </p>
  </div>
</section>

<?= loadPartial('footer') ?>
