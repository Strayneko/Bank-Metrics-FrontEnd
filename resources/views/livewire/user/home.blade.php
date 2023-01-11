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
                        <li class="w-56">Status</li>
                        <li class="">Action</li>
                    </div>
                </ul>

                <div class="bg-white">
                    <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
                    showUser: false,
                    width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
                    showDetail: false
                }" x-on:click="showUser = !showUser">
                        <div class="flex items-center gap-3">
                            <li class="w-9 text-center">1</li>
                            <li class="w-56">2022-01-19</li>
                        </div>
                        <div class="flex flex-col gap-3 pl-12 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showUser" x-transition.duration.700ms>
                            <li class="w-56" >Bank Ini</li>
                            <li class="w-56" >Approved</li>
                            <li class="w-24">
                                <a x-on:click="showDetail = true" class="cursor-pointer rounded-md bg-orange-1 px-3 py-1 text-white">Detail</a>
                            </li>
                        </div>

                        <div class="absolute inset-x-0 top-0 w-full" x-show="showDetail" x-transition.duration.300ms>
                            @livewire('components.modal.detail-submission')
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
