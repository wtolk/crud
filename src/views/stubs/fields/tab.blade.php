<div id="{{ $input->id }}">
    @foreach($input->renderedFields as $field)
        {!! $field !!}
    @endforeach
</div>