{{-- Start Seaction Detail Bang --}}
<section class="absolute inset-x-0 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-3/5 rounded-xl bg-white p-10 shadow-md shadow-navy/60">
    <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">Bank</span></h1>
      <div
        class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>
    <ul class="mx-auto mb-8 flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy">
      <li class="flex justify-between">
        <span class="inline-block w-48">Bank Name</span>
        <span class="w-full flex-1" x-text="bank.name"></span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Loaning Percentage</span>
        <span class="w-full flex-1" x-text="bank.loaning_percentage + ' %'"></span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Min Age</span>
        <span class="w-full flex-1" x-text="bank.min_age + ' Year'"></span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Max Age</span>
        <span class="w-full flex-1" x-text="bank.max_age + ' Year'"></span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Marital Status</span>
        <template x-if="bank.marital_status == 0 ">
          <span class="w-full flex-1">Single</span>
        </template>
        <template x-if="bank.marital_status == 1 ">
          <span class="w-full flex-1">Married</span>
        </template>
        <template x-if="bank.marital_status == 2 ">
          <span class="w-full flex-1">Both</span>
        </template>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Nationality</span>
        <template x-if="bank.nationality == 0 ">
          <span class="w-full flex-1">Citizen Only</span>
        </template>
        <template x-if="bank.nationality == 1 ">
          <span class="w-full flex-1">Foreigner Only</span>
        </template>
        <template x-if="bank.nationality == 2 ">
          <span class="w-full flex-1">Both</span>
        </template>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Employment</span>
        <template x-if="bank.employment == 0">
          <span class="w-full flex-1">Half-Time</span>
        </template>
        <template x-if="bank.employment == 1">
          <span class="w-full flex-1">Full-Time</span>
        </template>
        <template x-if="bank.employment == 2">
          <span class="w-full flex-1">Both</span>
        </template>
      </li>
    </ul>
    <a x-on:click="isShow = false"
      class="rounded-lg bg-[#f1f0f0] px-20 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Back</a>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isShow = false"></div>
</section>
{{-- End Seaction Detail Bang --}}
