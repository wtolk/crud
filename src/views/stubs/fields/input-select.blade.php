<div class="field">
    <label>{{$input->title}}</label>
    <select class="selectize-erarchy" name="{{$input->field_name }}" @if($input->required)required="required"@endif>
        @if($input->empty)
        <option value="{{$input->empty['value']}}" @if($input->field_value == $input->empty['value']) selected @endif > {{$input->empty['name']}} </option>
        @endif
        @foreach($input->options as $value => $option)
        <option value="{{$value}}" @if($input->field_value === $value) selected @endif > {{$option}} </option>
        @endforeach
    </select>
</div>
