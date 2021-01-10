<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Админ панель</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/wtolk/crud/css/adfm-panel.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="flex auth">
<div class="login-card">
    <div class="row">
        <div class="col col-12 text-center">
            <div class="h1">{{ __('Зарегистрироваться') }}</div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-8 col-md-offset-2">

            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field no-bg">
                    <label>{{ __('Ваше Имя') }}</label>
                    <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="field no-bg">
                    <label>{{ __('E-Mail') }}</label>
                    <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="field no-bg">
                    <label>{{ __('Пароль') }}</label>
                    <input type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="field no-bg">
                    <label>{{ __('Пароль еще раз') }}</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password">

                </div>


                <div class="text-center">
                    <button type="submit" class="button">
                        {{ __('Зарегистрировать') }}
                    </button>
                </div>


            </form>


        </div>
    </div>
</div>
</body>
