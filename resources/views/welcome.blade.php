<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lorem University</title>

    <!--Bootstrap-->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Styles -->
    <style>
        body {
            background: rgb(226, 230, 236);
            background: linear-gradient(90deg, rgba(226, 230, 236, 1) 0%, rgba(236, 239, 243, 1) 50%, rgba(215, 221, 230, 1) 100%);
            background: radial-gradient(circle, transparent 20%, #d7dde6 20%, #d7dde6 80%, transparent 80%, transparent) 0% 0% / 52px 52px, radial-gradient(circle, transparent 20%, #d7dde6 20%, #d7dde6 80%, transparent 80%, transparent) 26px 26px / 52px 52px, linear-gradient(#cdd5df 2px, transparent 2px) 0px -1px / 26px 26px, linear-gradient(90deg, #cdd5df 2px, #d7dde6 2px) -1px 0px / 26px 26px #d7dde6;
            background-size: 52px 52px, 52px 52px, 26px 26px, 26px 26px;
            font-family: 'Roboto', sans-serif;
            text-align: justify;
        }

        .hero {
            width: 100%;
            height: 100vh;
        }

        .hero-img {
            width: 30%;
            padding-right: 0.5rem;
        }

        .hero-text {
            width: 25rem;
            padding-left: 0.5rem;
        }

        .heading-color {
            color: #8897b4 !important;
        }

        .text-color {
            color: #14181f !important;
        }

        .primary-button {
            background-color: #97a4be;
            color: #14181f;
        }

        .secondary-button {
            background-color: #f6f8fa;
            color: #14181f;
            border style: solid;
            border-color: #14181f;
        }
    </style>
</head>

<body class="">

    <div class="hero d-flex mx-auto p-3 justify-content-center align-items-center">
        <img class="img-fluid hero-img" src="{{ asset('images\Online learning-amico.png') }}" alt="">
        <div class="hero-text">
            <p class="fw-semibold fs-2 heading-color">Lorem University</p>
            <p class="text-color">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="text-color"> Quos perferendis optio
                distinctio, nostrum eius
                sequi reprehenderit blanditiis culpa aliquam vel et beatae dolores pariatur aspernatur esse</p>
            <p class="text-color">et beatae dolores pariatur aspernatur esse
                temporibus
                alias enim deserunt.</p>

            <p class="text-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam error aperiam,
                asperiores corrupti ut
                esse?</p>
            <div class="d-flex justify-content-between row g-3">
                {{-- <button type="button" class="btn primary-button">Primary button</button>
                <button type="button" class="btn secondary-button">Primary button</button> --}}
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 d-flex justify-content-between">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn secondary-button col-md-5">
                                <div class="d-flex align-items-center">
                                    <p class="m-auto fw-normal">Dashboard</p>
                                    <i class="m-auto nav-icon fas fa-regular fa-arrow-right" style="color: #14181f;"></i>
                                </div>
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn primary-button col-md-5">Register</a>
                            @endif
                            <a href="{{ route('login') }}" class="btn secondary-button col-md-5">Log In</a>
                        @endauth
                    </div>
                @endif
            </div>


        </div>

        <!-- Bootstrap 5.3 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
            integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
        <!--Font Awesome-->
        <script src="https://kit.fontawesome.com/2c5b5e3390.js" crossorigin="anonymous"></script>
</body>

</html>
