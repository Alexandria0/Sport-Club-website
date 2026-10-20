<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se încarcă...</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: #FAFAFA;

            overflow: hidden;
        }

        .loader{
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease;
        }

        .loader img{
            width: 220px;
            height: auto;
        }

        @keyframes fadeIn{
            from{
                opacity: 0;
                transform: scale(0.9);
            }
            to{
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>

    <div class="loader">
        <img src="/images/loaading.gif" alt="Loading">
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 2000);
    </script>

</body>
</html>