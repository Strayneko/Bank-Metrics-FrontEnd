<div class="relative w-full">
  <div class="absolute inset-x-0 -top-20 z-20 mx-auto w-full lg:w-10/12">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="mb-2 text-2xl font-bold text-navy lg:text-3xl">Detail <span class="text-orange-2">Rejected</span></h1>
        <div
          class="relative h-2 w-[105%] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy lg:w-[335px]">
        </div>
      </div>

      <div class="relative mx-auto rounded-xl bg-white lg:w-10/12">
        <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-64">Bank</li>
          <li class="w-80">Reason</li>
        </ul>

        <template x-for="(reject, j) in resReject.data">
          <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center">
            <li class="w-10 text-center" x-text="j + 1"></li>
            <li class="w-64" x-text="reject.name"></li>
            <li class="w-80">
              <ul>
                <template x-for="reason of reject.loan_reason">
                  <li class="flex border-b border-b-navy/20 py-2">
                    <span x-text="reason"></span>
                  </li>
                </template>
              </ul>
            </li>
          </ul>
        </template>
      </div>

    </div>
  </div>
  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="showRejected = false"></div>
</div>
