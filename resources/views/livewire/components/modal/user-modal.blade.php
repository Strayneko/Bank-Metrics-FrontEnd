<div class="relative w-full">
  <div class="absolute inset-x-0 -top-40 z-20 mx-auto mb-48 lg:w-[575px]">
    <div class="relative mb-10 rounded-xl bg-white pb-10 pt-8 shadow-lg shadow-navy/50">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-2xl font-bold text-navy lg:text-3xl">Update <span class="text-orange-2">User</span> Profile</h1>
        <div
          class="relative h-2 w-full rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy lg:w-[340px]">
        </div>
      </div>
      <form class="flex cursor-pointer flex-col px-10" enctype="multipart/form-data" x-on:submit.prevent="updateProfile()"
        x-ref="userForm">
        <label for="name" class="relative w-full pb-3">
          <p class="font-bold text-navy">Name</p>
          <input type="text" name="name" id="name" class="peer mt-2 outline-none"
            placeholder="Insert your name" :value="userData.name" disabled>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>

        <label for="email" class="relative w-full pb-3">
          <p class="font-bold text-navy">Email</p>
          <input type="email" name="email" id="email" class="peer mt-2 outline-none"
            placeholder="Insert your email" :value="userData.email" disabled>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>

        <label for="address" class="relative w-full pb-0.5">
          <p class="font-bold text-navy">Address</p>
          <textarea type="text" name="address" id="address" class="peer mt-2 min-h-[50px] w-full outline-none"
            placeholder="Insert your address" :value="userData.profile ? userData.profile.address : ''" required></textarea>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>

        <label for="dob" class="relative w-full pb-3">
          <p class="font-bold text-navy">Date of Birth</p>
          <input type="date" name="dob" id="dob" class="peer mt-2 w-full text-navy outline-none"
            placeholder="Insert your date of birth" :value="userData.profile ? userData.profile.dob : ''" required>
          <div
            class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
          </div>
        </label>

        <label for="gender" class="relative w-full pb-3">
          <p class="font-bold text-navy">Gender</p>
          <div class="flex gap-5 pt-2">
            <div class="mb-4 flex items-center gap-5">
              <input type="radio" name="gender" id="female" value="0" class="h-5 w-5"
                :checked="userData.profile ? (userData.profile.gender == 0 ? true : false) : false">
              <label for="female" class="font-semibold text-navy">Female</label>
            </div>
            <div class="mb-4 flex items-center gap-5">
              <input type="radio" name="gender" id="male" value="1" class="h-5 w-5"
                :checked="userData.profile ? (userData.profile.gender == 1 ? true : false) : false">
              <label for="male" class="font-semibold text-navy">Male</label>
            </div>
          </div>
        </label>

        <label for="photo" class="relative w-full pb-3">
          <p class="font-bold text-navy">Photo</p>
          <input type="file" name="photo" id="photo" :required="!userData.profile"
            class="peer relative z-10 w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white font-semibold text-gray-3 transition-all duration-150 file:mr-3 file:cursor-pointer file:border-none file:bg-orange-1 file:px-4 file:py-2 file:font-medium file:text-navy file:outline-none before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-navy/60 hover:before:w-full">
        </label>

        <label for="country_id" class="relative w-full pb-3">
          <p class="font-bold text-navy">Nationality</p>
          <select name="country_id" id="country_id" required
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-300 hover:bg-orange-1">
            <option selected disabled value="null" class="bg-white font-semibold">Choose your nationality</option>
            <template x-if="userData.profile">
              <option :value="userData.profile.country_id" x-text="userData.profile.country.country_name" selected>
              </option>
            </template>
            <template x-for="country of dataCountry">
              <option :value="country.id" class="bg-white font-medium" x-text="country.name"></option>
            </template>
          </select>
        </label>

        <label for="marital_status" class="relative w-full pb-3">
          <p class="font-bold text-navy">Marital Status</p>
          <select name="marital_status" id="marital_status"
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-300 hover:bg-orange-1"
            required>
            <option disabled value="null" selected class="bg-white font-semibold">Choose your marital status</option>
            <option :selected="userData.profile ? (userData.profile.marital_status == 0 ? true : false) : false"
              value="0" class="bg-white font-medium">Single</option>
            <option :selected="userData.profile ? (userData.profile.marital_status == 1 ? true : false) : false"
              value="1" class="bg-white font-medium">Married</option>
          </select>
        </label>

        <label for="employement" class="relative w-full pb-3">
          <p class="font-bold text-navy">Employement</p>
          <select name="employement" id="employement"
            class="w-full cursor-pointer rounded-md border-2 border-orange-1 bg-white p-2 font-medium text-navy outline-none transition-all duration-300 hover:bg-orange-1"
            required>
            <option value="null" selected disabled class="bg-white font-semibold">Choose your employement</option>
            <option :selected="userData.profile ? (userData.profile.employement == 0 ? true : false) : false"
              value="0" class="bg-white font-medium">Half-Time</option>
            <option :selected="userData.profile ? (userData.profile.employement == 1 ? true : false) : false"
              value="1" class="bg-white font-medium">Full-Time</option>
          </select>
        </label>

        <div class="mt-5 flex flex-col justify-between gap-3 pb-4 lg:flex-row lg:gap-0">
          <button type="submit" :disabled="isSubmit"
            class="relative z-10 inline-block w-full rounded-lg border-2 border-orange-1 bg-transparent px-10 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max">Update
            Profile</button>
          <button type="button" x-on:click="isUpdate = false" :disabled="isSubmit"
            class="relative z-10 inline-block w-full rounded-lg border-2 border-orange-1 bg-transparent py-3 px-20 text-center font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full disabled:bg-orange-1 disabled:text-white lg:w-max">Back</button>
        </div>
      </form>
    </div>
  </div>
  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="isUpdate = false"></div>
</div>
