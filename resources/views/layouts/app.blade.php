<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Metrics</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  @livewireStyles

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script>
    function generateKey(api_path, request_time) {
      // create payload
      const payload =
        window.localStorage.getItem("token") +
        api_path +
        navigator.userAgent +
        request_time;
      // hash payload to generate api key
      return CryptoJS.SHA256(payload).toString();
    };
  </script>
</head>

<body>

  {{ $slot }}

  @livewireScripts
</body>

</html>
