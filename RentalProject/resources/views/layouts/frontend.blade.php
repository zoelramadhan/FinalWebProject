<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>YukRental</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" />
    <style>
                body {
            background-image: url('/img/bg.jpg');
            background-color: #FCF5ED;
            background-size: cover; /* agar background mencakup seluruh layar */
            background-attachment: fixed; /* agar background tetap saat menggulir */
        }

        .navbar {
            background-color: white ; /* mengatur warna latar belakang navbar menjadi transparan */
        
        }
    </style>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3 pb-3">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('homepage') }}" style="color: black">
                <img src="img/logoyukrental.png" style="max-height: 40px; max-width: 100%;">
                YukRental
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" onclick="document.getElementById('login-form').submit()" href="{{ route('login') }}">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span style="color: black">Login</span></a>
                            <form id="login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    @yield('content')
    <!-- Footer-->
    <footer class="py-3 bg-white position-fixed bottom-0 w-100">
        <div class="container">
            <p class="m-0 text-center text-dark">
                Copyright &copy; YukRental Website 2023
            </p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
</body>

</html>
