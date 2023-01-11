<section class="mt-20 w-full py-10 text-navy lg:mt-0 lg:w-[80%]">
  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <h1 class="mx-auto mb-10 w-max text-3xl font-bold" x-text="'Welcome ' + resData.data.name"></h1>

    <template x-if="resData.data.profile">
      <div class="overflow-hidden rounded-xl bg-white">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-64">Date</li>
          <div class="hidden gap-3 lg:flex">
            <li class="w-56">Bank</li>
            <li class="w-80">Status</li>
            <li>Action</li>
          </div>
        </ul>

        <div class="bg-white">
          <ul class="flex gap-3 px-3 py-4 font-semibold text-navy">
            <li class="w-10 text-center">1</li>
            <li class="w-64">2023-01-01</li>
            <div class="hidden gap-3 lg:flex">
              <li class="w-56">Bank Ini</li>
              <li class="w-80">Accepted</li>
              <li><a href="#">Detail</a></li>
            </div>
          </ul>
        </div>

      </div>
    </template>

    <template x-if="!resData.data.profile">
      <div class="flex min-h-[100px] items-center justify-center rounded-xl bg-white">
        <p class="text-xl font-semibold">Please fill in your personal data first!</p>
      </div>
    </template>
  </div>
</section>
