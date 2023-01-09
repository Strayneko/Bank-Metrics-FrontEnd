<section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
  <script>
    Alpine.data('usersDashboard', () => ({
      users: [],
      getUsers() {
        fetch(`{{ env('API_URL') }}/api/user`, {
          method: 'GET',
          headers: {
            'Content-type': 'application/json;charset=UTF-8',
            'Authorization': localStorage.getItem('token')
          }
        }).then(async res => {
          data = await res.json()
          this.users = data.data
          console.log(this.users)
        })
      }
    }))
  </script>

  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <div
      class="mb-10 flex w-full flex-wrap items-center justify-center gap-8 gap-y-12 rounded-xl bg-navy py-12 px-1 text-lg text-gray-2 md:gap-12 md:px-5 lg:gap-6 lg:text-xl">
      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/admin-white.svg') }}" alt="">
          </div>
        </div>
        <p>Admins</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/user-white.svg') }}" alt="">
          </div>
        </div>
        <p>Users</p>
        <p class="text-3xl">75</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/submission-white.svg') }}" alt="">
          </div>
        </div>
        <p>Submission</p>
        <p class="text-3xl">125</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/approve-white.svg') }}" alt="">
          </div>
        </div>
        <p>Approved</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/not-approved-white.svg') }}"
              alt="">
          </div>
        </div>
        <p class="leading-none">Not Approved</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>
    </div>

    <div class="bg-white" x-data="usersDashboard" x-init="getUsers()">
      <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-64">Nama</li>
        <div class="hidden gap-3 lg:flex">
          <li class="w-56">Tanggal Lahir</li>
          <li class="w-80">Alamat</li>
        </div>
      </ul>

      <template x-for="(user, i) of users">
        @livewire('components.list-user')
      </template>

    </div>
  </div>
</section>
