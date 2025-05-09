<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Monitoring Apps</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
</head>

<body class="inter-regular">
    @include('partials.navbar')
    <div class="container">
        @yield('content')
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    document.getElementById("location").value = latitude + ", " + longitude;
                }, function(error) {
                    alert("Gagal mendapatkan lokasi: " + error.message);
                });
            } else {
                alert("Geolocation tidak didukung di browser ini.");
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    document.getElementById("location_check_out").value = latitude + ", " + longitude;
                }, function(error) {
                    alert("Gagal mendapatkan lokasi: " + error.message);
                });
            } else {
                alert("Geolocation tidak didukung di browser ini.");
            }
        });
    </script>

</body>

</html>
