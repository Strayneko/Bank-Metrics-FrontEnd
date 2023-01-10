<nav class="fixed top-0 z-30 flex h-20 w-full items-center justify-between bg-orange-1 py-2 px-5 lg:hidden">
  <div class="relative px-1">
    <h1
      class="relative z-10 w-full text-3xl font-bold text-orange-2 before:absolute before:-left-3 before:top-0 before:-z-10 before:block before:h-[110%] before:w-[120%] before:-rotate-6 before:bg-gray-1">
      Met<span class="text-navy">rics</span></h1>
  </div>
  <div class="flex flex-col gap-1" x-on:click="showSidebar = !showSidebar">
    <span class="h-[3px] w-5 bg-orange-2 transition-all duration-300"
      :class="showSidebar ? '-rotate-45 origin-top-right' : ''"></span>
    <span class="h-[3px] w-5 bg-orange-2 transition-all duration-300" :class="showSidebar ? 'scale-0' : ''"></span>
    <span class="h-[3px] w-5 bg-orange-2 transition-all duration-300"
      :class="showSidebar ? 'rotate-45 origin-bottom-right' : ''"></span>
  </div>
</nav>
