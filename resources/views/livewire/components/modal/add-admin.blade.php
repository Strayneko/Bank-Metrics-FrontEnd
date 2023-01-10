<div class="w-full">
    <div class="w-[575px] mb-48 mx-auto absolute inset-x-0 z-40">
        <div class="relative bg-white pt-8  rounded-xl">
            <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
                <h1 class="text-3xl font-bold text-navy">Form <span class="text-orange-2">Create</span> Admin</h1>
                <div class="relative h-2 w-[340px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
                </div>
            </div>
            <form class="px-[39px] flex flex-col cursor-pointer">
                <label for="name" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Name</p>
                    <input type="text" name="name" id="name" class="peer outline-none mt-2" placeholder="Insert your name">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="email" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Email</p>
                    <input type="text" name="email" id="email" class="peer outline-none mt-2" placeholder="Insert your email address">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                </label>
                <label for="password" class="relative pb-3 w-full">
                    <p class="font-bold text-navy">Password</p>
                    <input type="password" name="password" id="password" class="peer outline-none mt-2" placeholder="Insert your password">
                    <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
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
