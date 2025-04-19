<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('top-banner') ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">All Jobs</div>
    <?= loadPartial('message') ?>
    <?= loadPartial('listings', ['listings' => $listings]) ?>
  </div>
</section>

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>
