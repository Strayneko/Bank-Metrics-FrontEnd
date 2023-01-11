<div class="relative w-full">
  <div class="absolute inset-x-0 -top-40 z-20 mx-auto mb-48 w-[575px]">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-navy">Update <span class="text-orange-2">User</span> Profile</h1>
        <div
          class="relative h-2 w-[340px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>
      <form class="flex cursor-pointer flex-col px-[39px]" enctype="multipart/form-data"
        x-on:submit.prevent="updateProfile()" x-ref="userForm">
        <label for="name" class="relative w-full pb-3">
          <p class="font-bold text-navy">Name</p>
          <input type="text" name="name" id="name" class="peer mt-2 outline-none"
            placeholder="Insert your name" :value="userData.name" disabled>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>

        <label for="email" class="relative w-full pb-3">
          <p class="font-bold text-navy">Email</p>
          <input type="email" name="email" id="email" class="peer mt-2 outline-none"
            placeholder="Insert your email" :value="userData.email" disabled>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>

        <label for="address" class="relative w-full pb-3">
          <p class="font-bold text-navy">Address</p>
          <textarea type="text" name="address" id="address" class="peer mt-2 w-full outline-none"
            placeholder="Insert your min age"></textarea>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>

        <label for="dob" class="relative w-full pb-3">
          <p class="font-bold text-navy">Date of Birth</p>
          <input type="date" name="dob" id="dob" class="peer mt-2 w-full outline-none"
            placeholder="Insert your date of birth" x-model="dob">
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 rounded-lg bg-navy transition-all duration-500 peer-hover:w-full">
          </div>
        </label>

        <label for="gender" class="relative w-full pb-3">
          <p class="font-bold text-navy">Gender</p>
          <div class="flex gap-5 pt-2">
            <div class="mb-4 flex items-center gap-5">
              <input type="radio" name="gender" id="female" value="0" class="h-5 w-5">
              <label for="female" class="font-semibold text-navy">Female</label>
            </div>
            <div class="mb-4 flex items-center gap-5">
              <input type="radio" name="gender" id="male" value="1" class="h-5 w-5">
              <label for="male" class="font-semibold text-navy">Male</label>
            </div>
          </div>
        </label>

        <label for="photo" class="relative w-full pb-3">
          <p class="font-bold text-navy">Photo</p>
          <input type="file" name="photo" id="photo"
            class="peer mt-2 w-full rounded-md bg-orange-1 p-2 outline-orange-1">
        </label>

        <label for="country_id" class="relative w-full pb-3">
          <p class="font-bold text-navy">Nationality</p>
          <select name="country_id" id="country_id" class="w-full rounded-md border border-orange-2 bg-orange-1 p-2">
            <option selected disabled class="font-semibold text-white">Choose your nationality</option>
            <option value="0" class="font-medium text-white">Indonesia</option>
            <option value="1" class="font-medium text-white">America</option>
            <option value="2" class="font-medium text-white">Other</option>
          </select>
        </label>

        <label for="marital_status" class="relative w-full pb-3">
          <p class="font-bold text-navy">Marital Status</p>
          <select name="marital_status" id="marital_status"
            class="w-full rounded-md border border-orange-2 bg-orange-1 p-2">
            <option selected disabled class="font-semibold text-white">Choose your marital status</option>
            <option value="0" class="font-medium text-white">Single</option>
            <option value="1" class="font-medium text-white">Married</option>
          </select>
        </label>

        <label for="employement" class="relative w-full pb-3">
          <p class="font-bold text-navy">Employement</p>
          <select name="employement" id="employement"
            class="w-full rounded-md border border-orange-2 bg-orange-1 p-2">
            <option selected disabled class="font-semibold text-white">Choose your employement</option>
            <option value="0" class="font-medium text-white">Full-Time</option>
            <option value="1" class="font-medium text-white">Half-Time</option>
          </select>
        </label>

        <div class="mt-5 flex justify-between pb-12">
          <button type="submit"
            class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Update
            Profile</button>
          <a x-on:click="isUpdate = false"
            class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Back</a>
        </div>
      </form>
    </div>
  </div>
  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isUpdate = false"></div>
</div>
