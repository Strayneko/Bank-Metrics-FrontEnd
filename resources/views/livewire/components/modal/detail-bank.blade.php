<section class="absolute inset-x-0  mx-auto w-full pb-12">
    <div class="relative z-20 mx-auto w-3/5 rounded-xl bg-white p-10 shadow-md shadow-navy/60">
        <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
            <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">Bank</span></h1>
            <div class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
            </div>
        </div>
        <ul class="mx-auto flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy mb-8">
            <li class="flex justify-between">
                <span class="inline-block w-48">Bank Name</span>
                <span class="flex-1 w-full">Bank of America</span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Loaning Percentage</span>
                <span class="flex-1 w-full">85%</span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Min Age</span>
                <span class="flex-1 w-full">18 <span>Year</span></span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Max Age</span>
                <span class="flex-1 w-full">65 <span>Year</span></span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Marital Status</span>
                <span class="flex-1 w-full">Married Only</span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Nationality</span>
                <span class="flex-1 w-full">America</span>
            </li>
            <li class="flex justify-between">
                <span class="inline-block w-48">Employment</span>
                <span class="flex-1 w-full">Full-Time</span>
            </li>
        </ul>
        <a x-on:click="isShow = false" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-20 py-3 rounded-lg">Back</a>
    </div>

    <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isShow = false"></div>
</section>
