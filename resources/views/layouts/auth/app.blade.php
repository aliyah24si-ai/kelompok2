<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    {{-- Volt / custom CSS assets --}}
    <link rel="stylesheet" href="{{ asset('assets-admin/css/volt.css') }}">
    
    {{-- FONT AWESOME (TAMBAHKAN INI) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<main>
    <section class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>