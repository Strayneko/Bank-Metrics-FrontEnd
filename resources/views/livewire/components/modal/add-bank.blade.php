<div class="w-full">
    <div class="w-[575px] mb-48 mx-auto absolute inset-x-0 z-40">
        <div class="relative bg-white pt-8  rounded-xl">
            <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
                <h1 class="text-3xl font-bold text-navy">Form <span class="text-orange-2">Create</span> Bank</h1>
                <div class="relative h-2 w-[340px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
                </div>
            </div>
            <form class="px-[39px] flex flex-col cursor-pointer" x-on:submit.prevent="createNewBank()">
                <label for="name" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Name</p>
                    <input type="text" name="name" id="name" class="peer outline-none mt-2" placeholder="Insert your name" x-model="newBank.name">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="loaning_percentage" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Loaning Percentage</p>
                    <input type="number" name="loaning_percentage" id="loaning_percentage" class="peer outline-none mt-2" placeholder="Insert your loaning percentage" x-model="newBank.loaning_percentage">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="min_age" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Min Age</p>
                    <input type="number" name="min_age" id="min_age" class="peer outline-none mt-2" placeholder="Insert your min age" x-model="newBank.min_age">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="max_age" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Max Age</p>
                    <input type="number" name="max_age" id="max_age" class="peer outline-none mt-2" placeholder="Insert your max age" x-model="newBank.max_age">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="marital_status" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Marital Status</p>
                    <select name="marital_status" id="marital_status" class="w-full bg-orange-1 p-2 border border-orange-2" x-model="newBank.marital_status">
                        {{-- <option selected disabled class="text-white font-semibold">Choose your marital status</option> --}}
                        <option value="0" class="text-white font-medium">Single Only</option>
                        <option value="1" class="text-white font-medium">Married Only</option>
                        <option value="2" class="text-white font-medium">Both</option>
                    </select>
                </label>
                <label for="nationality" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Nationality</p>
                    <select name="nationality" id="nationality" class="w-full bg-orange-1 p-2 border border-orange-2" x-model="newBank.nationality">
                        {{-- <option selected disabled class="text-white font-semibold">Choose your nationality</option> --}}
                        <option value="0" class="text-white font-medium">Indonesia</option>
                        <option value="1" class="text-white font-medium">America</option>
                        <option value="2" class="text-white font-medium">Other</option>
                    </select>
                </label>
                <label for="employment" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Employment</p>
                    <select name="employment" id="employment" class="w-full bg-orange-1 p-2 border border-orange-2" x-model="newBank.employment">
                        {{-- <option selected disabled class="text-white font-semibold">Choose your employment</option> --}}
                        <option value="0" class="text-white font-medium ">Full-Time</option>
                        <option value="1" class="text-white font-medium">Half-Time</option>
                        <option value="2" class="text-white font-medium">Both</option>
                    </select>
                </label>

                <div class="flex mt-5  justify-between pb-12">
                    <button type="submit" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-20 py-3 rounded-lg">Create</button>
                    <a x-on:click="isAddActive = false" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-20 py-3 rounded-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
    <div class="absolute inset-0 bg-gray-1/40 z-20 backdrop-blur-sm" x-on:click="isAddActive = false"></div>
</div>
