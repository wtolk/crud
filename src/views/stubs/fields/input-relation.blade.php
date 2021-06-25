<div class="field">
    <label>{{$input->title}}</label>
    <select @if($input->multiple)multiple @endif class="selectize-erarchy" name="{{$input->field_name }}@if($input->multiple)[] @endif" @if($input->required)required="required"@endif>
        @if($input->empty)
        <option value="{{$input->empty['value']}}" @if($input->field_value == $input->empty['value']) selected @endif > {{$input->empty['name']}} </option>
        @endif
        @foreach($input->options as $value => $option)
            @php
                $selected = ($input->field_value === $value or $input->default_value === $value or ($input->multiple && (array_key_exists($value, $input->field_value) or array_key_exists($value, $input->default_value) )) );
            @endphp
        <option value="{{$value}}" @if($selected) selected @endif > {{$option}} </option>
        @endforeach
    </select>
</div>

<script>
$(function() {
    $('select[name="{{$input->field_name }}@if($input->multiple)[] @endif"]').selectize({
        // plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
});
</script>
