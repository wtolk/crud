<ul data-tabs>
    @foreach($input->tabs as $i => $tab)
        <li><a @if($loop->first) data-tabby-default @endif href="#{{ $tab->id }}">{{ $tab->title }}</a></li>
    @endforeach
</ul>

@foreach($input->renderedTabs as $i => $tab)
    {!! $tab !!}
@endforeach