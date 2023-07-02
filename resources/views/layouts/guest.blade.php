<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        .heading {
            color: #8897b4 !important;
            font-size: 1.7rem;
            font-weight: 600;
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

        .center-div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-bg {
            background-color: #51657e;
        }

        .form-text-color {
            background-color: #eceff3;
        }

        .label-text {
            color: #f6f8fa;
        }
    </style>
</head>

<body class="">
    <div class="center-div">
        <div>
            <a href="/">
                <p class="heading">Lorem University</p>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 form-bg shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
