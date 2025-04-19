<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('showcase-search') ?>
<?= loadPartial('top-banner') ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>

    <?= loadPartial('listings', ['listings' => $listings]) ?>

    <a href="/listings" class="block text-xl text-center">
      <i class="fa fa-arrow-alt-circle-right"></i>
      Show All Jobs
    </a>
</section>

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>
