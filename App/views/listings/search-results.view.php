<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('showcase-search') ?>
<?= loadPartial('top-banner') ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Found Jobs</div>
    <?php if ($listings) : ?>
      <?= loadPartial('listings', ['listings' => $listings]) ?>
    <?php else : ?>
      <p class="text-slate-500 text-center font-semibold text-4xl">
        Nothing found!
      </p>
    <?php endif; ?>
  </div>
</section>

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>
