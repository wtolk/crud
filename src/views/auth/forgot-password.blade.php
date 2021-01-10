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
    @if (session('status'))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col col-12 text-center">
            <div class="h1">{{ __('Сбросить пароль') }}</div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-8 col-md-offset-2">

            <form class="form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field no-bg">
                    <label>{{ __('E-Mail') }}</label>
                    <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="button">
                        {{ __('Отправить ссылку для сброса пароля') }}
                    </button>
                </div>


            </form>


        </div>
    </div>
</div>
</body>
