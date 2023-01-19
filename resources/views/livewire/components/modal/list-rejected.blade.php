<div class="relative w-full">
  <div class="absolute inset-x-0 -top-20 z-20 mx-auto w-full lg:w-10/12">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="mb-2 text-2xl font-bold text-navy lg:text-3xl">Detail <span class="text-orange-2">Rejected</span></h1>
        <div
          class="relative h-2 w-[105%] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy lg:w-[335px]">
        </div>
      </div>

      <div class="relative mx-auto w-11/12 rounded-xl bg-gray-1/30 lg:w-10/12">
        <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-64">Bank</li>
          <li class="hidden w-80 lg:block">Reason</li>
        </ul>

        <template x-if="resReject.length == 0">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <template x-if="isLoad">
              <div class="mb-5">
                <div class="flex h-20 w-full items-center justify-center">
                  <div class="loading"></div>
                </div>
              </div>
            </template>
            <h1 x-text="showMessage"></h1>
          </div>
        </template>

        <template x-for="(reject, j) in resReject.data">
          <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center"
            x-data="{
                width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
                showReason: false,
            }" x-on:click="showReason = !showReason">
            <div class="flex gap-3">
              <li class="w-10 text-center" x-text="j + 1"></li>
              <li class="w-64" x-text="reject.name"></li>
            </div>
            <li class="w-full lg:w-80" x-show="width > 768 ? true : showReason" x-transition.duration.500ms>
              <ul class="pr-5 pl-14 lg:pr-0 lg:pl-0">
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
  <div class="fixed inset-0 z-10 bg-white/10 backdrop-blur-sm" x-on:click="showRejected = false"></div>
</div>
