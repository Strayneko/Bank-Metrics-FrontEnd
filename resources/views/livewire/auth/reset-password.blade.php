
  <div class="container" x-data="Forgot" x-init="checkLogged()">
    <div class="flex justify-between pt-[56px]">
      <div class="">
        <div class="">
          <a href="">
            <img src="{{ asset('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mx-auto lg:mx-0 lg:mb-0 lg:ml-5">
          </a>
        </div>
        <div class="m-5 rounded-2xl bg-[#FCC997] md:m-0 md:mx-10 md:block md:w-[685px] lg:mx-0 lg:hidden lg:p-0">
          <img src="{{ asset('assets/register.png') }}" alt=""
            class="mx-auto w-[596px] p-5 md:mx-auto md:w-full md:p-20 lg:pt-14">
        </div>
        <div class="mt-5 md:mt-10 lg:mt-20">
          <h1 class="items-center text-center font-poppins text-lg font-semibold text-[#0F0742] lg:text-[32px]">Form Forgot Password
          </h1>
        </div>
        <div class="mt-5 md:mx-5 md:mt-8 lg:mt-10">
          <form x-on:submit.prevent="forgot()" method="" action="" enctype="multipart/form-data">
            <div class="m-5 lg:m-0 lg:mb-6">
              <label for="password"
                class="mb-2 block font-poppins text-sm font-medium text-[#0F0742] dark:text-white">Password</label>
              <input x-model="user.password" type="password" id="password" name="password"
                class="w-full rounded-lg border border-[#FCC997] p-2.5 md:w-full lg:w-[380px]"
                placeholder="Insert your password" required>
            </div>
            <div class="m-5 lg:m-0 lg:mb-6">
              <label for="password"
                class="mb-2 block font-poppins text-sm font-medium text-[#0F0742] dark:text-white">Confirm Password</label>
              <input x-model="user.password" type="password" id="password" name="password"
                class="w-full rounded-lg border border-[#FCC997] p-2.5 md:w-full lg:w-[380px]"
                placeholder="Insert your confirm password" required>
            </div>
            <div class="m-5 mb-20 flex justify-between gap-5 lg:m-0 lg:mb-0 lg:gap-0">
              <button type="submit"
                class="mt-5 w-full rounded-lg border border-[#FCC997] p-2.5 px-5 text-center font-poppins font-bold text-[#0F0742] hover:bg-[#ff972f] hover:text-white lg:mt-5 lg:w-[175px]">Send</button>
              <a href="{{ url('/login') }}"
                class="mt-5 w-full rounded-lg bg-[#FCC997] px-5 py-2.5 text-center font-poppins font-bold text-white hover:border hover:border-[#FCC997] hover:bg-[#f4f4f4] hover:text-[#0F0742] lg:mt-5 lg:w-[175px]">Cancel</a>
  
            </div>
          </form>
        </div>
      </div>
      <div
        class="hidden rounded-2xl bg-[#FCC997] md:mx-10 md:hidden md:h-[538px] md:w-[430px] lg:m-0 lg:block lg:h-[513px] lg:w-[573px] xl:h-[515px] xl:w-[693px]">
        <img src="{{ asset('assets/register.png') }}" alt=""
          class="mx-auto md:w-[620px] md:p-5 md:pt-32 lg:w-[880px] lg:pt-10 lg:p-5 xl:pt-0">
      </div>
    </div>
  </div>
  