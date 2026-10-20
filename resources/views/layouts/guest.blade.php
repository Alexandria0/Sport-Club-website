<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FONTURI CA LA SITE -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="auth-container">

    {{ $slot }}

</div>

</body>

<style>
    body {
    font-family: 'Montserrat', sans-serif;
}
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
}

/* CARD */
.auth-box {
    width: 100%;
    max-width: 520px;
    border: 1px solid #e5e5e5;
    border-radius: 25px;
    padding: 40px;
    background: white;
}

/* TITLU */
.auth-title {
    font-family: 'Oswald', sans-serif;
    font-size: 36px;
    text-align: center;
    margin-bottom: 30px;
}

/* INPUT */
.auth-input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #ccc;
    margin-top: 5px;
}

/* LABEL */
.auth-label {
    font-size: 15px;
}

/* BUTTON */
.auth-btn {
    width: 100%;
    padding: 12px;
    border-radius: 15px;
    border: none;
    background: #000;
    color: white;
    margin-top: 20px;
    cursor: pointer;
}

.auth-btn:hover {
    opacity: 0.9;
}
</style>
</html>