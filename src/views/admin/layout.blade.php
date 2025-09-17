<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Админ панель</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @vite('resources/vendor/wtolk/crud/scss/adfm-panel.scss')
    <script src="/vendor/wtolk/crud/admin-crud-bundle.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <aside class="sideBar"><img id="sidebg" src="/vendor/wtolk/crud/img/sidebar-wallpaper.jpg">
        <div class="side-menu">
            <div class="panel-name">ADFM CMS</div>
            @foreach($form->mainMenu as $itemMenu)
            @if(is_array($itemMenu))
                    <div class="block-links">
                        <div class="title">{{array_keys($form->mainMenu)[$loop->index]}}</div>
                        @foreach($itemMenu as $subitem)
                            <a href="{{route($subitem->route)}}"><i class="material-icons">{{$subitem->icon}}</i><span>{{$subitem->title}}</span></a>
                        @endforeach
                    </div>
                @else
                    <a href="{{route($itemMenu->route)}}"><i class="material-icons">{{$itemMenu->icon}}</i><span>{{$itemMenu->title}}</span></a>
                @endif
            @endforeach
        </div>
    </aside>

    <div class="main-page">
        <!-- Content Header (Page header) -->

        {{--        {{ getBanner()|raw }}--}}

        <div class="page-content-wrapper">
            @yield('content')
        </div>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.confirm-action').click(function (e) {
            let result = window.confirm('Вы уверены ?');
            if (result === false) {
                e.preventDefault();
            };
        });
    });
    let tabs = new Tabby('[data-tabs]');

</script>
</body>
</html>


