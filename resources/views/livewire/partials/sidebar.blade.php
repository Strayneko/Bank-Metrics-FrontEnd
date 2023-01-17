<aside
  class="fixed inset-y-0 z-30 flex h-screen flex-col items-center bg-white pt-10 pl-2 pr-0 transition-all duration-500 lg:left-0 lg:pl-8"
  :class="showSidebar ? 'left-0' : '-left-96'">

  <script>
    Alpine.data('logout', () => ({
      logout() {
        Swal.fire({
          title: 'Are you sure?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, sign out!'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`{{ env('API_URL') }}/api/auth/logout`, {
              method: 'POST',
              headers: {
                'Authorization': this.token
              }
            }).then(async res => {
              const data = await res.json()

              if (data.status) {
                localStorage.setItem('logout', true)
                localStorage.removeItem('token')
                window.location.replace(`{{ route('login') }}`)
              }
            })
          }
        })
      }
    }))
  </script>

  <div class="relative mb-16">
    <h1
      class="relative z-10 w-full text-4xl font-bold text-orange-2 before:absolute before:-left-4 before:-top-1 before:-z-10 before:block before:h-[110%] before:w-[125%] before:-rotate-6 before:bg-gray-1">
      Met<span class="text-navy">rics</span></h1>
  </div>

  <!-- loading -->
  <template x-if="resData.length == 0">
    <div class="my-10 ml-10 text-center text-2xl font-bold text-navy">
      <h1 x-text="showMessage"> </h1>
    </div>
  </template>

  <div :class="resData.length == 0 ? 'hidden' : ' '" class="mb-3 flex flex-col items-center justify-center text-gray-2">
    <div class="mb-3 flex h-24 w-24 items-center justify-center overflow-hidden rounded-full bg-gray-1">
      <img class="w-full"
        :src="resData.data ?
            (resData.data.profile ? resData.data.profile.photo : `{{ asset('assets/profile.svg') }}`) :
            `{{ asset('assets/profile.svg') }}`"
        :alt="resData.data ? resData.data.name : 'Profile'" />
    </div>
    <p class="text-xl font-bold" x-text="resData.data ? resData.data.name : 'User'"></p>
    <p class="text-sm" x-text="resData.data ? resData.data.role.role_name : 'User'"></p>
  </div>

  <div :class="resData.length == 0 ? 'hidden' : ' '"
    class="show-scroll my-3 w-full overflow-auto pt-8 text-base font-semibold text-navy">
    <ul class="mb-14 flex flex-col gap-8 px-8">
      <li>
        <a href="{{ route('home') }}"
          class="{{ request()->routeIs('home') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[120%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/home.svg') }}" alt=""></div>
          <span>Dashboard</span>
        </a>
      </li>

      <template x-if="roleId == 1">
        <div :class="resData.length == 0 ? 'hidden' : ' '" class="flex flex-col gap-8">
          <li>
            <a href="{{ route('user.profile') }}"
              class="{{ request()->routeIs('user.profile') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/user.svg') }}" alt=""></div>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="{{ route('user.user-submission') }}"
              class="{{ request()->routeIs('user.user-submission') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[120%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/submission.svg') }}" alt="">
              </div>
              <span>Submission</span>
            </a>
          </li>
        </div>
      </template>

      <template x-if="roleId == 2">
        <div :class="resData.length == 0 ? 'hidden' : ' '" class="flex flex-col gap-8">
          <li>
            <a href="{{ route('admin.list') }}"
              class="{{ request()->routeIs('admin.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/admin.svg') }}" alt=""></div>
              <span>Admin</span>
            </a>
          </li>
          <li>
            <a href="{{ route('user.list') }}"
              class="{{ request()->routeIs('user.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/user.svg') }}" alt=""></div>
              <span>User</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{ route('submission.list') }}"
              class="{{ request()->routeIs('submission.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[115%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/submission.svg') }}" alt="">
              </div>
              <span>Submission</span>
            </a>
          </li> --}}
          <li>
            <a href="{{ route('bank.list') }}"
              class="{{ request()->routeIs('bank.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[115%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/bank.svg') }}" alt="">
              </div>
              <span>Bank</span>
            </a>
          </li>
        </div>
      </template>
    </ul>

    <div :class="resData.length == 0 ? 'hidden' : ' '" class="mb-10 px-8" x-data="logout">
      <a x-on:click="logout()"
        class="relative z-10 flex w-full cursor-pointer items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rotate-6 before:rounded-lg before:bg-gray-3 before:opacity-0 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
        <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/logout.svg') }}" alt=""></div>
        <span>Sign Out</span>
      </a>
    </div>
  </div>
</aside>
