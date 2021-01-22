<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Админ панель</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/wtolk/crud/css/adfm-panel.css') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/wtolk/crud/js/admin.js') }}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

{{--    <link rel="stylesheet" href="/panel/admin/css/bootstrap.min.css">--}}
    {{--    <link rel="stylesheet" href="/panel/admin/css/style.css">--}}
    {{--    <link rel="stylesheet" href="/panel/admin/css/admin-menu.css">--}}

    <!-- Nestable -->
    {{--    <link rel="stylesheet" href="/panel/admin/css/selectize.default.css">--}}
    {{--    <link rel="stylesheet" href="/panel/admin/css/nestable.css">--}}


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    {{--    <script type="text/javascript" href="/panel/plugins/ckeditor/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            CKEDITOR.replace('editor1', {--}}
{{--                filebrowserBrowseUrl: '/filemanager',--}}
{{--                allowedContent: true--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
{{--    {% include 'admin-menu.twig' %}--}}

    <aside class="sideBar"><img id="sidebg" src="/vendor/wtolk/crud/img/sidebar-wallpaper.jpg">
        <div class="side-menu">
            <div class="panel-name">ADFM CMS</div>

        {{--            {% set admin_menu = getAdminMenuItems() %}--}}

{{--            {% for item in admin_menu.standart %}--}}
{{--            <a href="/admin/{{item.link}}"><i class="fa {{item.fa_ico}}"></i> <span>{{item.title}}</span> </a>--}}

{{--            {% if item.children|length > 0 %}--}}
{{--            <div class="sidebar-submenu">--}}
{{--                <ul class="sidebar-menu">--}}
{{--                    {% for child in item.children %}--}}
{{--                    <li>--}}
{{--                        <a href="/admin/{{child.link}}">--}}
{{--                            <i class="fa {{child.fa_ico}}"></i>--}}
{{--                            <span>{{child.title}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    {% endfor %}--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            {% endif %}--}}

{{--            {% endfor %}--}}

{{--            {% for item in admin_menu.modules %}--}}
{{--            <hr class="delimeter">--}}
{{--            <a href="/admin/{{item.link}}">--}}
{{--                <i class="fa {{item.fa_ico}}"></i>--}}
{{--                <span>{{item.title}}</span>--}}
{{--            </a>--}}
{{--            {% if item.submenu %}--}}
{{--            <div class="sidebar-submenu">--}}
{{--                <ul class="sidebar-menu">--}}
{{--                    {% for sub in item.submenu %}--}}
{{--                    <li><a href="/admin/{{sub.link}}"><i class="fa {{sub.fa_ico}}"></i><span>{{sub.title}}</span></a></li>--}}
{{--                    {% endfor %}--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            {% endif %}--}}

{{--            {% if loop.last %}--}}
{{--            <hr class="delimeter">--}}
{{--            {% endif %}--}}
{{--            {% endfor %}--}}

            <!--<li><a href="/admin/files"><i class="fa-file fa"></i><span>Файлы</span></a></li>-->
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
            <a href="/admin/settings"><i class="fa-gear fa"></i><span>Конфигурация</span></a>
            <div class="sidebar-submenu">
                <ul class="sidebar-menu">
                    <li><a href="/admin/settings/redirects"><i class="fa"></i><span>Перенаправления</span></a></li>
                </ul>
            </div>
        </div>

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="main-page">
        <!-- Content Header (Page header) -->

{{--        {{ getBanner()|raw }}--}}

        <div class="page-content-wrapper">
            @yield('content')
        </div>
    </div>


</div>

<!-- ./wrapper -->
<script>

    if(window.matchMedia('(max-width: 768px)').matches)
    {
        let val = 90;
        $('body').append(`
                <span class="sandwitch">|||</span>
                `);
        $('span.sandwitch').css({transform: 'rotate(' + val + 'deg)'});
        $('span.sandwitch').on('click', function () {
            $(this).css('display', 'none');
            $('aside.sideBar').css({
                'position': 'fixed',
                'margin-left': '0px',
                'z-index': 100,
            });
            $(document).mouseup(function (e) {
                let container = $('aside.sideBar');
                if (container.has(e.target).length === 0){
                    container.css({
                        'margin-left': '-200px',
                    });
                }
                $('span.sandwitch').css('display', 'block');
            });
        });
    } else {
        $('span.sandwitch').css('display', 'none');
        $('aside.sideBar').css({
            'position': 'fixed',
            'margin-left': '0px',
            'z-index': 100,
        });
    }



</script>

{{--{% block script %}--}}
{{--{% endblock %}--}}

<!-- Скрипт загрузки файлов -->
{{--<script src="/panel/admin/js/filepanel.js"></script>--}}
{{--<script src="/panel/admin/js/flatpickr.js"></script>--}}
{{--<script src="/panel/admin/js/ru.js"></script>--}}

<!-- Bootstrap 3.3.5 -->
{{--<script src="/panel/admin/js/bootstrap.min.js"></script>--}}

{{--<script src="/panel/plugins/ckeditor/ckeditor.js"></script>--}}
{{--<script src="/panel/admin/js/jquery.nestable.js"></script>--}}
<!-- custom script -->
{{--<script src="/panel/admin/js/custom.js"></script>--}}

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/d16a633ce5.js" crossorigin="anonymous"></script>
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</body>
</html>


