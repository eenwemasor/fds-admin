<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Intruder Detection System</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            padding: none;
            margin: 0px
        }

        .landing-page-wrapper {
            width: 100vw;
            height: 100vh;
        }

        .landing-page {
            width: 100%;
            height: 100%;
            background: url('https://cdn.arstechnica.net/wp-content/uploads/2022/10/pi-4.jpg');

            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .content{
            background-color: rgba(0, 0, 0, 0.281)

        }
        .content .title {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            padding : 30px;
        }

        .content h1 {
            color: white;
            font-size: 150px;
            margin: 0px;
            padding: 0px;
            line-height: 90%;
        }

        .content h3 {
            text-align: end;
            padding-right: 30px;
            margin-top: -10px;
            color: burlywood;
            font-size: 40px;
        }

        .auth-indicator{
            display: flex;
            gap: 10px;
            position: absolute;
            top: 10px;
            right: 40px
        }
        .auth-indicator a{
            background-color: white;
            text-decoration: none;
            color: #BF1747;
            padding: 10px 30px;
            border-radius: 5px;

        }

    </style>


</head>

<body class="landing-page-wrapper">
    <div class="auth-container">
        @if (Route::has('login'))
            <div class="auth-indicator">
                @auth
                    <a href="{{ url('/dashboard') }}" class="dashboard-button">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="login-button">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="register-button">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    </div>
    <div class="landing-page">
        <div></div>
        <div class="content">
            <div class="title">
                <h1>Intruder </h1>
                <h1>Detection</h1>
                <h1>System</h1>
            </div>
            <h3>Administration</h3>
        </div>
    </div>
</body>

</html>
