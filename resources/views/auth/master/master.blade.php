<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    @include('auth.master.header')



    @yield('content')
    <!-- Login Card Container -->


    @include('auth.master.footer')
    </html>
</x-guest-layout>

