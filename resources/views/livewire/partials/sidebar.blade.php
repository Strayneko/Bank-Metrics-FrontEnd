<aside class="fixed left-0 flex h-screen flex-col items-center py-10 pl-12 pr-10">
  <div class="relative mb-16">
    <h1
      class="relative z-10 w-full text-4xl font-bold text-orange before:absolute before:-left-4 before:-top-1 before:-z-10 before:block before:h-[110%] before:w-[125%] before:-rotate-6 before:bg-gray-1">
      Met<span class="text-navy">rics</span></h1>
  </div>

  <div class="mb-10 flex flex-col items-center justify-center text-gray-2">
    <div class="mb-3 h-24 w-24 overflow-hidden rounded-full">
      <img class="w-full" src="{{ asset('images/profile.svg') }}" alt="profile" />
    </div>
    <p class="text-xl font-bold">Firman Supirman</p>
    <p class="text-sm">Admin Bank X</p>
  </div>

  <div class="text-base font-semibold text-navy">
    <ul class="mb-14 flex flex-col gap-8">
      <li>
        <a href="#"
          class="relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[105%] before:-rotate-[5deg] before:rounded-lg before:bg-gray-3">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/home.svg') }}" alt=""></div>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center gap-4">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/processor.svg') }}" alt=""></div>
          <span>Submission</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center gap-4">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/approve.svg') }}" alt=""></div>
          <span>Approved</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center gap-4">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/not-approved.svg') }}" alt="">
          </div>
          <span>Not Approved</span>
        </a>
      </li>
    </ul>

    <div>
      <a href="#" class="flex items-center gap-4">
        <div class="w-6"><img class="w-full" src="{{ asset('images/icons/logout.svg') }}" alt=""></div>
        <span>Sign Out</span>
      </a>
    </div>
  </div>
</aside>
