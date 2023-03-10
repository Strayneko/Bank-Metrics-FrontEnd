<script>
  Alpine.data("Forgot", () => ({
    user: {
      email: "",
    },
    msg: '',
    isLoad: false,
    forgot() {
      this.isLoad = true

      /**
       * Create form data
       */
      const data = new FormData()
      data.append('email', this.user.email)

      fetch(`{{ env('API_URL') }}/api/passwordReset`, {
        method: "POST",
        body: data
      }).then(async (response) => {
        this.isLoad = false
        let data = await response.json()
        let status = data.status
        this.msg = data.message
        // console.log(data)

        /**
         * Show error message is response status is false
         */
        if (status == false) {
          let msg = ``
          for (m of this.msg) {
            msg += m
          }
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: msg
          })
          // window.location.replace('')
          return
        }

        // success alert
        Swal.fire(
          'Success!', 'Send Email Succes, Please Check Your Email!', 'success'
        )
      });
    },
    token: localStorage.getItem('token'),
    checkLogged() {
      /**
       * Redirect to home if there is token in localstorage
       */
      if (this.token) {
        setTimeout(() => {
          window.location.replace(`{{ route('home') }}`)
        }, 0);
      }
    }
  }));
</script>
<div class="container" x-data="Forgot" x-init="checkLogged()">
  <template x-if="isLoad">
    <div class="fixed inset-0 z-[100] bg-white/10 backdrop-blur-sm">
      <div class="flex h-screen w-full items-center justify-center bg-gray-1/30">
        <div class="loading"></div>
      </div>
    </div>
  </template>
  <div class="flex justify-between pt-[56px]">
    <div class="">
      <div class="">
        <a href="">
          <img src="{{ asset('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mx-auto lg:mx-0 lg:mb-0">
        </a>
      </div>
      <div class="m-5 rounded-2xl bg-[#FCC997] md:m-0 md:mx-10 md:block md:w-[685px] lg:mx-0 lg:hidden lg:p-0">
        <img src="{{ asset('assets/register.png') }}" alt=""
          class="mx-auto w-[596px] p-5 md:mx-auto md:w-full md:p-20 lg:pt-14">
      </div>
      <div class="mt-5 md:mt-10 lg:mt-20">
        <h1 class="items-center text-center font-poppins text-lg font-semibold text-[#0F0742] lg:text-[32px]">Forgot
          Password
        </h1>
      </div>
      <div class="mt-5 md:mx-5 md:mt-8 lg:mt-10">
        <form x-on:submit.prevent="forgot()" method="" action="" enctype="multipart/form-data">
          <div class="m-5 lg:m-0 lg:mb-6">
            <label for="email"
              class="mb-2 block font-poppins text-sm font-medium text-[#0F0742] dark:text-white">Email</label>
            <input x-model="user.email" type="email" id="email" name="email"
              class="w-full rounded-lg border border-[#FCC997] p-2.5 md:w-full lg:w-[380px]"
              placeholder="Insert your email address" required>
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
      class="hidden rounded-2xl bg-[#FCC997] md:mx-10 md:hidden md:h-[538px] md:w-[430px] lg:m-0 lg:block lg:h-[417px] lg:w-[593px] xl:lg:h-[415px] xl:lg:w-[693px]">
      <img src="{{ asset('assets/register.png') }}" alt=""
        class="mx-auto md:w-[620px] md:p-5 md:pt-32 lg:w-full lg:p-5 lg:pt-1 xl:w-[550px]">
    </div>
  </div>
</div>
