{{-- Start pagination --}}
<div class="flex justify-end px-10 pt-3 pb-6">
  <ul class="flex w-max items-center rounded-md font-semibold text-orange-1 outline outline-2 outline-orange-1">
    <li>
      <button class="group py-1 pl-3 disabled:cursor-not-allowed" type="button" x-on:click="viewPage(0)"
        :disabled="pageNumber == 0">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11 4L3 11L11 19" stroke="#FF5927" stroke-width="3.77953" stroke-linejoin="round"
            class="group-hover:animate-arrowColor1" />
          <path d="M20 4L12 11L20 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
            class="group-hover:animate-arrowColor2" />
        </svg>
      </button>
    </li>

    <li>
      <button class="group py-1 pr-4 disabled:cursor-not-allowed" type="button" x-on:click="viewPage(pageNumber - 1)"
        :disabled="pageNumber == 0">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 4L12 11L20 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
            class="transition-all duration-200 group-hover:stroke-orange-2/60" />
        </svg>
      </button>
    </li>

    <li class="-mr-[.25px]">
      <button type="button" x-on:click="viewPage(0)"
        class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
        :class="pageNumber == 0 ? 'bg-orange-1 text-white' : ''">1</button>
    </li>

    <template x-for="num in pages">
      <li class="-mr-[.25px]" :hidden="pageNumber != num || pageNumber == 0 || pageNumber == pages.length - 1">
        <button type="button" x-on:click="viewPage(num)"
          class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
          x-text="num + 1" :class="pageNumber == num ? 'bg-orange-1 text-white' : ''"></button>
      </li>
    </template>

    <li class="-mr-[.25px]" :hidden="pages.length - 1 == 0">
      <button type="button" x-on:click="viewPage(pages.length - 1)"
        class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
        x-text="pages.length" :class="pageNumber == pages.length - 1 ? 'bg-orange-1 text-white' : ''"></button>
    </li>

    <li>
      <button class="group py-1 pl-4 disabled:cursor-not-allowed" type="button" x-on:click="viewPage(pageNumber + 1)"
        :disabled="pageNumber == (pages.length - 1)">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.44653 4L10.4465 11L2.44653 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
            class="transition-all duration-200 group-hover:stroke-orange-2/60" />
        </svg>
      </button>
    </li>

    <li>
      <button class="group py-1 pr-3 disabled:cursor-not-allowed" type="button" x-on:click="viewPage(pages.length - 1)"
        :disabled="pageNumber == (pages.length - 1)">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.4465 4L19.4465 11L11.4465 19" stroke="#FF5927" stroke-width="3.77953" stroke-linejoin="round"
            class="group-hover:animate-arrowColor1" />
          <path d="M2.44653 4L10.4465 11L2.44653 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
            class="group-hover:animate-arrowColor2" />
        </svg>
      </button>
    </li>
  </ul>
</div>
{{-- End Pagination --}}
