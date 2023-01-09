<section class="mt-20 w-full py-10 text-navy lg:mt-0 lg:w-[80%]">
  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <h1 class="mx-auto mb-10 w-max text-3xl font-bold" x-text="'Welcome ' + resData.data.name"></h1>

    <template x-if="resData.data.profile">
      <div class="flex justify-center gap-10 bg-white">
        <div class="bg-orange-1">
          <div>
            <img class="w-full" src="" alt="ini gambar">
          </div>
        </div>
        <div>
          <p x-text="resData.data."></p>
          <p>Hello</p>
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
