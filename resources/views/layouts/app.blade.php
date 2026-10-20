<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet"> 
<!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <style>
            .footer {
    background: #000;
    color: #fff;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    overflow: hidden;
}

/* CONTENT */
.footer-content {
    display: flex;
    justify-content: space-between;
    padding: 100px 40px;
    gap: 40px;
}

/* LEFT */
.footer-left h4 {
    font-size: 12px;
    letter-spacing: 1px;
    margin-bottom: 15px;
    opacity: 0.7;
}

.footer-left p {
    font-size: 14px;
    margin-bottom: 6px;
}

/* RIGHT */
.footer-right {
    max-width: 500px;
}

.footer-right .quote {
    font-style: italic;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 10px;
}

.footer-right .author {
    font-size: 12px;
    opacity: 0.7;
}

/* BOTTOM */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    text-align: center;
    padding: 15px;
    font-size: 12px;
    opacity: 0.7;
}
.footer-bg-text {
    width: 100%;
    text-align: center;
    font-size: 250px;
    font-weight: 1000;
    font-family: 'Oswald', sans-serif;
    color: #f3f3f3;

    letter-spacing: 10px;

    margin-bottom: -70px; /* 🔥 îl bagă peste footer */
    user-select: none;
    pointer-events: none;
}
.footer-contact {
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 8px 20px;
    font-size: 14px;
}

.footer-contact div:first-child,
.footer-contact div:nth-child(3) {
    font-weight: 500;
}

/* FIX MOBILE OVERFLOW */
html,
body{
    overflow-x: hidden;
    width: 100%;
}

/* FOOTER TEXT */
@media(max-width:1024px){

    .footer-bg-text{
        font-size: 120px;
        letter-spacing: 4px;
        margin-bottom: -30px;
    }

    .footer-content{
        flex-direction: column;
        padding: 60px 20px;
    }

    .footer-right{
        max-width: 100%;
    }
}

@media(max-width:768px){

    .footer-bg-text{
        font-size: 60px;
        margin-bottom: -10px;
    }

    .footer-content{
        padding: 40px 16px;
    }

    .footer-contact{
        grid-template-columns: 1fr;
        gap: 5px;
    }
}
            </style>
        <div class="bg-white overflow-x-hidden">
            @include('layouts.navigation')

            <!-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

            <main>
                {{ $slot }}
            </main>
            <div class="footer-bg-text">
    MOVEMENT
</div>
            <footer class="footer">
    <div class="footer-content">

        <div class="footer-left">
            <h4>CONTACTE</h4>

            <div class="footer-contact">
    <div>Email</div>
    <div>laravel.sport.club@gmail.com</div>

    <div>Telefon</div>
    <div>+373 67 226 590</div>
</div>
        </div>

        <div class="footer-right">
            <p class="quote">
                Lumea aceasta este o mare sală de sport în care noi venim pentru a deveni puternici.
            </p>
            <p class="author">– SWAMI VIVEKANANDA</p>
        </div>

    </div>

    <div class="footer-bottom">
        © Sport Club - Practica 2026
    </div>
</footer>

        </div>
    </body>
</html>
