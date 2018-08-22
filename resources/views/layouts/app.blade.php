@include('partials.header')
<div id="app">
    @include('partials.navbar')
    <main class="py-4">
        @yield('content')
    </main>
</div>
@include('partials.footer')
