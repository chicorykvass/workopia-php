<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('top-banner') ?>

<!-- Post a Job Form Box -->
<section class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
    <form method="POST" action="/listings/<?= $listing['id'] ?>">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Job Info
      </h2>

      <?php if (isset($errors)) : ?>
        <div class="mb-3">
          <?php foreach ($errors as $error) : ?>
            <div class="message text-red-950 bg-red-100 my-2 px-3 py-1">
              <?= $error ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="flex flex-wrap mb-4">
        <input type="hidden" name="_method" value="PUT">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="title">
          Title
        </label>
        <input
          type="text"
          name="title"
          id="title"
          placeholder="Job Title"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['title'] ?? '' ?>" />
      </div>

      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="description">
          Description
        </label>
        <textarea
          name="description"
          id="description"
          placeholder="Job Description"
          class="w-full px-4 py-2 border rounded focus:outline-none"><?= $listing['description'] ?? '' ?></textarea>
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="salary">
          Salary
        </label>
        <input
          type="text"
          name="salary"
          id="salary"
          placeholder="Annual Salary"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['salary'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="requirements">
          Requirements
        </label>
        <input
          type="text"
          name="requirements"
          id="requirements"
          placeholder="Requirements"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['requirements'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="benefits">
          Benefits
        </label>
        <input
          type="text"
          name="benefits"
          id="benefits"
          placeholder="Benefits"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['benefits'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="tags">
          Tags
        </label>
        <input
          type="text"
          name="tags"
          id="tags"
          placeholder="Tags"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['tags'] ?? '' ?>" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info & Location
      </h2>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="company">
          Company Name
        </label>
        <input
          type="text"
          name="company"
          id="company"
          placeholder="Company Name"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['company'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="address">
          Address
        </label>
        <input
          type="text"
          name="address"
          id="address"
          placeholder="Address"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['address'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="city">
          City
        </label>
        <input
          type="text"
          name="city"
          id="city"
          placeholder="City"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['city'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="state">
          State
        </label>
        <input
          type="text"
          name="state"
          id="state"
          placeholder="State"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['state'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="phone">
          Phone
        </label>
        <input
          type="text"
          name="phone"
          id="phone"
          placeholder="Phone"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['phone'] ?? '' ?>" />
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-1" for="email">
          Email Address
        </label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Email Address For Applications"
          class="w-full px-4 py-2 border rounded focus:outline-none"
          value="<?= $listing['email'] ?? '' ?>" />
      </div>
      <button
        class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
        Save
      </button>
      <a
        href="/listings/<?= $listing['id'] ?>"
        class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        Cancel
      </a>
    </form>
  </div>
</section>

<?= loadPartial('footer') ?>
