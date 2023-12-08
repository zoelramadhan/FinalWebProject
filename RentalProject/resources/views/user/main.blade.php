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
            background-size: cover;
            /* agar background mencakup seluruh layar */
            background-attachment: fixed;
            /* agar background tetap saat menggulir */
        }

        .navbar {
            background-color: ;
            /* mengatur warna latar belakang navbar menjadi transparan */
        }
    </style>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('user.index') }}" style="color: black">
                <img src="img/logoyukrental.png" style="max-height: 40px; max-width: 100%;">
                YukRental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" style="color: black"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto" >
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black">
                            {{ Auth::check() ? Auth::user()->name : 'Menu' }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="color: black">
                            <a class="dropdown-item" href="{{ route('user.index') }}">Home</a>
                            <a class="dropdown-item" href="{{ route('user.car') }}">Daftar Mobil</a>
                            <a class="dropdown-item" href="{{ route('user.driver') }}">Daftar Driver</a>
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>

                            <div class="dropdown-divider" style="color: black"></div>
                            <a class="nav-link" onclick="document.getElementById('logout-form').submit()"
                                href="#">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span style="color: red" >Log Out</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header-->
    @yield('content')

    <!-- Footer-->
    <footer class="py-3 bg-dark position-fixed bottom-0 w-100 mt-5">
        <div class="container">
            <p class="m-0 text-center text-white">
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
