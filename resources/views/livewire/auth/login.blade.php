<script>
  Alpine.data("Login", () => ({
    user: {
      email: "",
      password: ""
    },
    dataResponse: [],
    login() {
      const data = new FormData()
      data.append('email', this.user.email)
      data.append('password', this.user.password)

      fetch(`{{ env('API_URL') }}/api/user/login`, {
          method: "POST",
          body: data
        })
        .then(async (response) => {
          this.dataResponse = await response.json()
          // console.log(this.dataResponse.message)

          if (this.dataResponse.status == false) {
            alert(this.dataResponse.message)
            window.location.replace('')
          } else {
            localStorage.setItem('token', this.dataResponse.data.auth.token)
            window.location.replace(`{{ env('APP_URL') }}`)
          }
        });
    }
  }));
</script>
<div class="container" x-data="Login">
  <div class="flex justify-between pt-[56px]">
    <div class="">
      <div class="">
        <a href="">
          <img src="{{ asset('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mx-auto lg:mx-0 lg:mb-0">
        </a>
      </div>
      <div class="m-5 rounded-2xl bg-[#FCC997] md:hidden lg:p-0">
        <img src="{{ asset('assets/IconLogin.png') }}" alt="" class="mx-auto w-[596px] p-5 lg:pt-14">
      </div>
      <div class="mt-5 lg:mt-20">
        <h1 class="items-center text-center font-poppins text-lg font-semibold text-[#0F0742] lg:text-[32px]">Sign In
        </h1>
      </div>
      <div class="mt-5 lg:mt-10">
        <form x-on:submit.prevent="login()" method="" action="" enctype="multipart/form-data">
          <div class="m-5 lg:m-0 lg:mb-6">
            <label for="email"
              class="mb-2 block font-poppins text-sm font-medium text-[#0F0742] dark:text-white">Email</label>
            <input x-model="user.email" type="email" id="email" name="email"
              class="w-full rounded-lg border border-[#FCC997] p-2.5 md:w-[280px] lg:w-[380px]"
              placeholder="Insert you email address" required>
          </div>
          <div class="m-5 lg:m-0 lg:mb-6">
            <label for="password"
              class="mb-2 block font-poppins text-sm font-medium text-[#0F0742] dark:text-white">Password</label>
            <input x-model="user.password" type="password" id="password" name="password"
              class="w-full rounded-lg border border-[#FCC997] p-2.5 lg:w-[380px]" placeholder="Insert you password"
              required>
          </div>
          <div class="m-5 text-right">
            <a href="" class="font-poppins text-[#0F0742] hover:text-[#4d36e4]">Forgot Password?</a>
          </div>
          <div class="m-5 mb-20 flex justify-between gap-5 lg:m-0 lg:mb-0 lg:gap-0">
            <button type="submit"
              class="mt-5 w-full rounded-lg bg-[#FCC997] px-5 py-2.5 font-poppins font-bold text-white hover:border hover:border-[#FCC997] hover:bg-[#f4f4f4] hover:text-[#0F0742] lg:mt-0 lg:w-[175px]">Login</button>
            <a href="{{ url('/Register') }}"
              class="mt-5 w-full rounded-lg border border-[#FCC997] p-2.5 px-5 text-center font-poppins font-bold text-[#0F0742] hover:bg-[#ff972f] hover:text-white lg:mt-0 lg:w-[175px]">Sign
              Up</a>
          </div>
        </form>
      </div>
    </div>
    <div
      class="hidden rounded-2xl bg-[#FCC997] md:mx-10 md:block md:h-[490px] md:w-[430px] lg:m-0 lg:h-[540px] lg:w-[793px]">
      <img src="{{ asset('assets/IconLogin.png') }}" alt=""
        class="mx-auto md:w-[420px] md:p-5 md:pt-24 lg:w-[550px] lg:pt-8">
    </div>
  </div>
</div>
