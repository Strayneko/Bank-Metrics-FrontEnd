<section class="absolute inset-x-0 -top-32 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-3/5 rounded-xl bg-white p-10 shadow-md shadow-navy/60">
    <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">User</span></h1>
      <div
        class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>

    <div class="mx-auto mb-3 h-24 w-24 overflow-hidden rounded-full">
      <img class="w-full" src="{{ asset('assets/profile.svg') }}" alt="profile" />
    </div>

    <ul class="mx-auto flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy">
      <li class="flex justify-between"><span class="inline-block w-40">Name </span><span class="flex-1">Apriando
          Pratama</span></li>
      <li class="flex justify-between"><span class="inline-block w-40">Email </span><span
          class="flex-1">apriando@mail.com</span></li>
      <li><span class="inline-block w-40">Date Of Birth </span>1999-04-21</li>
      <li><span class="inline-block w-40">Gender </span>Laki-laki</li>
      <li class="flex justify-between"><span class="inline-block w-40">Address </span><span class="flex-1">Jl. Sitohang
          IIjhfkjsfdhsk
          sjdhfkdshfkhs fdsjhfkdjshfk
          dshkfdsk</span></li>
      <li><span class="inline-block w-40">Status </span>Single</li>
      <li><span class="inline-block w-40">Employment </span>Full-Time</li>
      <li><span class="inline-block w-40">Nationality </span>Indonesia</li>
    </ul>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
