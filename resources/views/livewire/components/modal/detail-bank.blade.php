{{-- Start Seaction Detail Bang --}}
<section class="absolute inset-x-0 top-10 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-full rounded-xl bg-white p-10 shadow-md shadow-navy/60 lg:w-3/5">
    <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">Bank</span></h1>
      <div
        class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>
    <ul class="mx-auto mb-8 flex flex-col gap-3 rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy lg:gap-0">
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Bank Name</span>
        <span class="w-full flex-1" x-text="bank.name"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Loaning Percentage</span>
        <span class="w-full flex-1" x-text="bank.loaning_percentage + ' %'"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Min Age</span>
        <span class="w-full flex-1" x-text="bank.min_age + ' Year'"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Max Age</span>
        <span class="w-full flex-1" x-text="bank.max_age + ' Year'"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Marital Status</span>
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
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Nationality</span>
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
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-52 text-base font-normal lg:text-lg lg:font-semibold">Employment</span>
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
      class="relative z-10 inline-block w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 text-center font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white">Back</a>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isShow = false"></div>
</section>
{{-- End Seaction Detail Bang --}}
