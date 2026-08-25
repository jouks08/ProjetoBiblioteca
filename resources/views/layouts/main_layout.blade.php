<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca Top</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/livro.png') }}" type="image/png">
</head>

<body>
    @yield('content')
    <script src="{{ asset('assets/bootstrap/boostrap.bundle.min.js') }}">
    </script>
</body>


</html>