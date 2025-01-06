<!DOCTYPE html>
<html lang="en">
@include('layouts/head')
<body>
    <!-- Navbar -->
    @include('layouts/navbar')

    <!-- Main Content -->
    <main>
        @auth('admin')
            @if(!request()->routeIs('login'))
            @include('layouts/main')
            @endif
        @endauth

        <!-- Content Wrapper -->
        @include('layouts/wrapper')
    </main>

    <!-- Footer -->
    @include('layouts/footer')

    <!-- Scripts -->
    @include('layouts/scripts')
    @stack('scripts')

</body>
</html>
