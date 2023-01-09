<div class="w-full">
  <div class="absolute inset-x-0 z-40 mx-auto mb-48 w-[575px]">
    <div class="relative rounded-xl bg-white pt-8">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-navy">Form <span class="text-orange-2">Create</span> Admin</h1>
        <div
          class="relative h-2 w-[340px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>
      <form x-on:submit.prevent="create()" class="flex cursor-pointer flex-col px-[39px]">
        <label for="name" class="relative w-full pb-3">
          <p class="font-bold text-navy">Name</p>
          <input type="text" name="name" id="name" class="peer mt-2 outline-none"
            placeholder="Insert your name" x-model="newAdmin.name">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>
        <label for="email" class="relative w-full pb-3">
          <p class="font-bold text-navy">Email</p>
          <input type="text" name="email" id="email" class="peer mt-2 outline-none"
            placeholder="Insert your email address" x-model="newAdmin.email">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>
        <label for="password" class="relative w-full pb-3">
          <p class="font-bold text-navy">Password</p>
          <input type="password" name="password" id="password" class="peer mt-2 outline-none"
            placeholder="Insert your password" x-model="newAdmin.password">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>
        <div class="mt-5 flex justify-between pb-12">
          <button type="submit"
            class="rounded-lg bg-[#f1f0f0] px-20 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Create</button>
          <a x-on:click="isAddActive = false"
            class="rounded-lg bg-[#f1f0f0] px-20 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Back</a>
        </div>
      </form>
    </div>
  </div>
  <div class="absolute inset-0 z-20 bg-gray-1/40 backdrop-blur-sm" x-on:click="isAddActive = false"></div>
</div>
