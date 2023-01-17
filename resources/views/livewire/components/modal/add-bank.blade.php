<div class="relative w-full">
  <div class="absolute inset-x-0 -top-28 z-20 mx-auto mb-48 lg:w-[575px]">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-navy">Form <span class="text-orange-2">Create</span> Bank</h1>
        <div
          class="relative h-2 w-72 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <form class="flex cursor-pointer flex-col px-10" x-on:submit.prevent="createNewBank()">
        <label for="name" class="relative w-full pb-3">
          <p class="font-bold text-navy">Name</p>
          <input type="text" name="name" id="name" class="peer mt-2 outline-none"
            placeholder="Insert your name" x-model="newBank.name">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-200 peer-hover:w-full">
          </div>
        </label>

        <label for="loaning_percentage" class="relative w-full pb-3">
          <p class="font-bold text-navy">Loaning Percentage</p>
          <input type="number" name="loaning_percentage" id="loaning_percentage" class="peer mt-2 w-full outline-none"
            placeholder="Insert your loaning percentage" x-model="newBank.loaning_percentage">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-200 peer-hover:w-full">
          </div>
        </label>

        <label for="min_age" class="relative w-full pb-3">
          <p class="font-bold text-navy">Min Age</p>
          <input type="number" name="min_age" id="min_age" class="peer mt-2 w-full outline-none"
            placeholder="Insert your min age" x-model="newBank.min_age">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-200 peer-hover:w-full">
          </div>
        </label>

        <label for="max_age" class="relative w-full pb-3">
          <p class="font-bold text-navy">Max Age</p>
          <input type="number" name="max_age" id="max_age" class="peer mt-2 w-full outline-none"
            placeholder="Insert your max age" x-model="newBank.max_age">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-200 peer-hover:w-full">
          </div>
        </label>

        <label for="marital_status" class="relative w-full pb-3">
          <p class="font-bold text-navy">Marital Status</p>
          <select name="marital_status" id="marital_status"
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-200 hover:bg-orange-1"
            x-model="newBank.marital_status">
            {{-- <option selected disabled class="text-white font-semibold">Choose your marital status</option> --}}
            <option value="0" class="bg-white font-medium">Single Only</option>
            <option value="1" class="bg-white font-medium">Married Only</option>
            <option value="2" class="bg-white font-medium">Both</option>
          </select>
        </label>

        <label for="nationality" class="relative w-full pb-3">
          <p class="font-bold text-navy">Nationality</p>
          <select name="nationality" id="nationality"
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-200 hover:bg-orange-1"
            x-model="newBank.nationality">
            {{-- <option selected disabled class="text-white font-semibold">Choose your nationality</option> --}}
            <option value="0" class="bg-white font-medium">Indonesia Only</option>
            <option value="1" class="bg-white font-medium">Foreigner Only</option>
            <option value="2" class="bg-white font-medium">Both</option>
          </select>
        </label>

        <label for="employment" class="relative w-full pb-3">
          <p class="font-bold text-navy">Employment</p>
          <select name="employment" id="employment"
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-200 hover:bg-orange-1"
            x-model="newBank.employment">
            {{-- <option selected disabled class="text-white font-semibold">Choose your employment</option> --}}
            <option value="0" class="bg-white font-medium">Half-Time</option>
            <option value="1" class="bg-white font-medium">Full-Time</option>
            <option value="2" class="bg-white font-medium">Both</option>
          </select>
        </label>

        <div class="mt-5 flex flex-col justify-between gap-3 pb-4 lg:flex-row lg:gap-0">
          <button type="submit" :disabled="isSubmit"
            class="relative z-10 inline-block w-full rounded-lg border-2 border-orange-1 bg-transparent py-3 text-center font-bold text-navy outline-none transition-all duration-200 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-200 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max lg:px-20">Create</button>
          <button type="button" x-on:click="isAddActive = false" :disabled="isSubmit"
            class="relative z-10 inline-block w-full rounded-lg border-2 border-orange-1 bg-transparent py-3 text-center font-bold text-navy outline-none transition-all duration-200 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-200 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max lg:px-20">Back</button>
        </div>
      </form>

    </div>
  </div>
  <div class="fixed inset-0 z-10 bg-white/10 backdrop-blur-sm" x-on:click="isAddActive = false"></div>
</div>
