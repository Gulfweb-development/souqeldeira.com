<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('app.app_name') | @lang('app.login')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
            font-family: "Cairo", sans-serif !important;
        }

        html,
        body {
            margin: 0;
        }

        .full-screen-container {
            background-image: url("{{ asset('images/login_bg.jpg') }}");
            height: 100vh;
            width: 100vw;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: hsla(201, 100%, 6%, 0.9);
            padding: 50px 30px;
            min-width: 500px;
            width: 50%;
            max-width: 600px;
        }

        .login-title {
            color: #fff;
            text-align: center;
            margin: 0;
            margin-bottom: 40px;
            font-size: 2.5em;
            font-weight: normal;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .input-group label {
            color: #fff;
            font-weight: lighter;
            font-size: 1.5em;
            margin-bottom: 7px;
            text-align: center;
            /* margin-bottom: 10px; */
        }

        .input-group input {
            font-size: 1.5em;
            padding: 0.1em 0.25em;
            background-color: hsla(201, 100%, 91%, 0.3);
            border: 1px solid hsl(201, 100%, 6%);
            outline: none;
            border-radius: 5px;
            color: #fff;
            font-weight: lighter;
        }

        .input-group input:focus {
            border: 1px solid hsl(201, 100%, 50%);
        }

        .login-button {
            padding: 10px 30px;
            width: 100%;
            border-radius: 5px;
            background: hsla(201, 100%, 50%, 0.1);
            border: 1px solid hsl(201, 100%, 50%);
            outline: none;
            font-size: 1.5em;
            color: #fff;
            font-weight: lighter;
            margin-top: 20px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: hsla(201, 100%, 50%, 0.3);
        }

        .login-button:focus {
            background-color: hsla(201, 100%, 50%, 0.5);
        }

        .error-msg {
            background-color: rgb(255, 190, 190);
            color: rgb(168, 0, 0);
            padding: 6px 10px;
            border-radius: 5px;
            margin-top: 2px;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="full-screen-container">
        <div class="login-container">
            <h3 class="login-title">@lang('app.app_name')</h3>
            @if (Session::has('error'))
                <p class="error-msg">{{ Session::get('error') }}</p>
            @endif
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>@lang('app.email')</label>
                    <input type="email" name="email" value="{{ old('email') }}" />
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label>@lang('app.password')</label>
                    <input type="password" name="password" />
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="login-button">@lang('app.login')</button>
            </form>
        </div>
    </div>
</body>

</html>
