<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('shared.head')

<body>
    @include('shared.header')
    @include('shared.aside')
    <main id="main" class="main">
        @yield('content')
    </main>


    @include('shared.footer')
    @include('shared.script')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>
