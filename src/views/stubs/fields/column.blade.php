<div class="{{$input->class}}"> <!-- Первая панель -->
    @foreach($input->renderedFields as $field)
        {!! $field !!}
    @endforeach
</div>