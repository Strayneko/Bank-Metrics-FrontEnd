<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        @yield('containt')
    </div>

    <script>
        AOS.init();

    </script>
</body>
</html>
