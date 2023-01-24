<section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
  <script>
    Alpine.data('usersDashboard', () => ({
      showMessage: 'Please wait...',
      users: [],
      admins: [],
      submissions: [],
      approved: [],
      rejected: [],
      acceptedSubmission: [],
      rejectedSubmission: [],
      headers: {
        'Content-type': 'application/json;charset=UTF-8',
        'Authorization': localStorage.getItem('token')
      },
      fetchData() {
        this.getAdmin();
        this.getLoanData();
        this.getUsers();
      },
      getAdmin() {

        const reqTime = Date.now(); //get current timestamp
        const path = '/api/admin';
        const apiKey = generateKey(path, reqTime); //generate api kay
        const headers = this.headers;
        headers['Request-Time'] = reqTime; // add Request time to header
        headers['D-App-Key'] = apiKey; //add api key to header

        // request
        fetch(`{{ env('API_URL') }}${path}`, {
            method: 'GET',
            headers,
          })
          .then(res => res.json())
          .then(res => this.admins = res.data)
          .catch(err => {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Internal Server Error! Please Try Again Later.',
            })
          })
      },
      getLoanData() {
        const reqTime = Date.now();
        const path = '/api/loan/all';
        const apiKey = generateKey(path, reqTime);
        const headers = this.headers;
        headers['Request-Time'] = reqTime;
        headers['D-App-Key'] = apiKey;

        fetch(`{{ env('API_URL') }}${path}`, {
          method: 'GET',
          headers,
        }).then(res => res.json()).then(res => {
          this.submissions = res.data
          // filter accepted submission
          this.acceptedSubmission = this.submissions.filter((submission) => submission.status === 1)
          // filter rejected submission
          this.rejectedSubmission = this.submissions.filter((submission) => submission.status === 0)
        }).catch(err => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Internal Server Error! Please Try Again Later.',
          })
        })
      },
      isLoad: false,
      getUsers() {
        this.isLoad = true
        const reqTime = Date.now();
        const path = '/api/user';
        const apiKey = generateKey(path, reqTime);
        const headers = this.headers;
        headers['Request-Time'] = reqTime;
        headers['D-App-Key'] = apiKey;

        fetch(`{{ env('API_URL') }}${path}`, {
          method: 'GET',
          headers,
        }).then(res => res.json()).then(res => {
          this.users = res.data.slice(0, 5)
          this.showMessage = 'No Data Found!'
          this.isLoad = false
        }).catch(err => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Internal Server Error! Please Try Again Later.',
          })
        })
      },

    }))
  </script>

  <div x-data="usersDashboard" x-init="fetchData"
    class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    {{-- Start Section Navbar --}}
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
        <p class="text-3xl" x-text="admins.length"></p>
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
        <p class="text-3xl" x-text="users.length"></p>
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
        <p class="text-3xl" x-text="submissions.length">Please wait...</p>
        <p>Data</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 md:h-32 md:w-40 md:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/approve-white.svg') }}" alt="">
          </div>
        </div>
        <p>Approved</p>
        <p class="text-3xl" x-text="acceptedSubmission.length">70</p>
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
        <p class="leading-none">Rejected</p>
        <p class="text-3xl" x-text="rejectedSubmission.length">70</p>
        <p>Person</p>
      </div>
    </div>
    {{-- End Section Navbar --}}

    {{-- Start Section Table --}}
    <div class="overflow-hidden rounded-xl bg-gray-1/30 lg:bg-white">
      <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-64">Name</li>
        <div class="hidden gap-3 lg:flex">
          <li class="w-56">Date Of Birth</li>
          <li class="w-80">Address</li>
        </div>
      </ul>

      <template x-if="users.length == 0">
        <div class="my-10 text-center text-2xl font-bold text-navy">
          <template x-if="isLoad">
            <div class="mb-5">
              <div class="flex h-20 w-full items-center justify-center">
                <div class="loading"></div>
              </div>
            </div>
          </template>
          <h1 x-text="showMessage"></h1>
        </div>
      </template>

      <template x-for="(user, i) of users">
        @livewire('components.list-user')
      </template>

    </div>
    {{-- End Section Table --}}
  </div>
</section>
