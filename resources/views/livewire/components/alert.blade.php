<div class="w-full pt-10 sm:pt-16">
    @if (session()->has('success'))
        <div class="w-full py-3 duration-150 rounded-lg px-7 bg-opacity-80 bg-desicon-green text-desicon-white">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="w-full py-3 duration-150 rounded-lg px-7 bg-opacity-80 bg-desicon-blue text-desicon-white">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="w-full py-3 duration-150 rounded-lg px-7 bg-opacity-80 bg-desicon-red text-desicon-white">
            {{ session('message') }}
        </div>
    @endif
</div>
