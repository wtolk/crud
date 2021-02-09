@php
    $confirm = null;
    if ($button->title == 'Удалить' || $button->method == 'DELETE') {
        $confirm = true;
    }
@endphp
@if($button->method != 'POST' && $button->method != 'GET' && !$button->submit)
    <form action="{{route($button->route, request()->route('id'))}}" method="POST">
        @method($button->method)
        @csrf
        @endif
        <button @if($button->submit)type="submit" form="main-form"@endif class="button confirm-action">{{$button->title}} </button>
        @if($button->method != null)
    </form>
@endif
{{--@if($item->exists)--}}
{{--    <form action="{{route('adfm.pages.destroy', $item->id)}}" method="POST">--}}
{{--        @method('DELETE')--}}
{{--        @csrf--}}
{{--        <button type="submit">Удалить страницу</button>--}}
{{--    </form>--}}
{{--    <a href="/api/page/{{ $item->id }}/clone">--}}
{{--        <button type="button" class="button">Клонировать страницу</button>--}}
{{--    </a>--}}
{{--    <a href="/admin/menus/links/add/Page/{{$item->id}}">--}}
{{--        <button type="button" class="button">Добавить в меню</button>--}}
{{--    </a>--}}
{{--@endif--}}
