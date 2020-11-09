@if(!$link->href)
@php($link->href = route($link->route, $link->route_param))
@endif
@if($link->method == 'GET')
<a @if($link->class)class="button"@endif href="{{$link->href}}">{!! $link->title !!}</a>
@else
<form action="{{$link->href}}" method="POST">
    @method($link->method)
    @csrf
    <button class="link">{!! $link->title !!}</button>
</form>
@endif
