@php
    $confirm = false;
    if ($link->title == 'Удалить' || $link->method == 'DELETE') {
        $confirm = true;
    }
@endphp

@if(!$link->href)
@php($link->href = route($link->route, $link->route_param))
@endif
@if($link->method == 'GET')
<a @if($link->class)class="button  @if($confirm) confirm-action @endif "@endif href="{{$link->href}}">{!! $link->title !!}</a>
@else
<form action="{{$link->href}}" method="POST">
    @method($link->method)
    @csrf
    <button class="link @if($confirm) confirm-action @endif">{!! $link->title !!}</button>
</form>
@endif
