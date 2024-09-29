@if (session('success'))
    <div id="banner-alert"
        class="w-full max-md:min-h-12 md:h-12 max-md:py-2 px-3 flex items-center bg-sky-600 rounded-md shadow mb-3 text-white max-md:text-sm">
        <p>
            <strong class="max-md:hidden">Success : </strong>
            <span>{{ session('success') }}</span>
        </p>
    </div>
@endif
