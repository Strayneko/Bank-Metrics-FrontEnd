{{-- Start Seaction Detail Submission --}}
<section class="absolute inset-x-0 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-3/5 rounded-xl bg-white p-10 shadow-md shadow-navy/60">
    <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">Submission</span></h1>
      <div
        class="relative h-2 w-72 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>
    <ul class="mx-auto mb-8 flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy">
      <li class="flex justify-between">
        <span class="inline-block w-48">Name</span>
        <span class="w-full flex-1">Ciman</span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Bank Name</span>
        <span class="w-full flex-1">Bank Ini</span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Loan Amound</span>
        <span class="w-full flex-1">$ 5000</span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-48">Status</span>
        <span class="w-full flex-1 text-[#028647]">Approved</span>
      </li>
    </ul>
    <a x-on:click="showDetail = false"
      class="rounded-lg bg-[#f1f0f0] px-20 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Back</a>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
{{-- End Seaction Detail Submission --}}
