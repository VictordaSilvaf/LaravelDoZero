@extends('layouts.base')
@section('body')
    <div class="grid grid-cols-5 overflow-hidden">
        <div class="h-screen max-h-screen px-2 py-5 bg-desicon-white">
            @livewire('components.left-menu')
        </div>
        
        <div class="min-h-screen col-span-3 overflow-y-auto bg-[#F5F6FA] px-7 py-5">
            @yield('content')
        </div>

        <div class="h-screen max-h-screen overflow-y-auto bg-desicon-white">
            @livewire('components.right-menu')
        </div>
    </div>

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection