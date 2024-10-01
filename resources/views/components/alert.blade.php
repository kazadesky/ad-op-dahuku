@if (session('success'))
    <div id="banner-alert"
        class="w-full max-md:min-h-12 md:h-12 max-md:py-2 px-3 flex items-center bg-sky-600 rounded-md shadow mb-3 text-white-text max-md:text-sm">
        <p>
            <strong class="max-md:hidden">Success : </strong>
            <span>{{ session('success') }}</span>
        </p>
    </div>
@endif

@if (session('logout'))
    <div id="banner-alert"
        class="w-full md:max-w-sm max-md:max-w-[300px] max-md:h-11 md:h-12 max-md:py-2 px-3 flex items-center bg-blue-600 md:rounded-md max-md:rounded-sm shadow mb-3 text-white-text max-md:text-sm absolute md:top-2 md:right-2 max-md:top-3 max-md:right-3">
        <p class="leading-tight">
            <strong class="max-md:hidden">Success : </strong>
            <span>{{ session('logout') }}</span>
        </p>
    </div>
@endif

@if (session('delete'))
    <div id="banner-alert"
        class="w-full md:max-w-sm max-md:max-w-[300px] max-md:h-11 md:h-12 max-md:py-2 px-3 flex items-center bg-blue-600 md:rounded-md max-md:rounded-sm shadow mb-3 text-white-text max-md:text-sm absolute md:top-2 md:right-2 max-md:top-3 max-md:right-3">
        <p class="leading-tight">
            <strong class="max-md:hidden">Success : </strong>
            <span>{{ session('delete') }}</span>
        </p>
    </div>
@endif
