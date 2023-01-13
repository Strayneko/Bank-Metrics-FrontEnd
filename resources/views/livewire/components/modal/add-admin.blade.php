<div class="relative w-full">
  <div class="absolute inset-x-0 -top-28 z-20 mx-auto w-full lg:w-[575px]">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="mb-2 text-2xl font-bold text-navy lg:text-3xl">Form <span class="text-orange-2">Create</span> Admin
        </h1>
        <div
          class="relative h-2 w-[105%] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy lg:w-[335px]">
        </div>
      </div>
      <form x-on:submit.prevent="create()" class="flex cursor-pointer flex-col gap-3 px-[39px]">
        <label for="name" class="relative w-full pb-3">
          <p class="font-bold text-navy">Name</p>
          <input type="text" name="name" id="name" class="peer mt-2 outline-none"
            placeholder="Insert your name" x-model="newAdmin.name">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>
        <label for="email" class="relative w-full pb-3">
          <p class="font-bold text-navy">Email</p>
          <input type="text" name="email" id="email" class="peer mt-2 outline-none"
            placeholder="Insert your email address" x-model="newAdmin.email">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>
        <label for="password" class="relative w-full pb-3">
          <p class="font-bold text-navy">Password</p>
          <input type="password" name="password" id="password" class="peer mt-2 outline-none"
            placeholder="Insert your password" x-model="newAdmin.password">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>
        <div class="mt-5 flex w-full flex-col items-center justify-center gap-5 text-center lg:flex-row lg:gap-14">
          <button type="submit" :disabled="isSubmit"
            class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max">Create</button>
          <button type="button" x-on:click="isAddActive = false" :disabled="isSubmit"
            class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max">Back</button>
        </div>
      </form>
    </div>
  </div>
  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isAddActive = false"></div>
</div>
