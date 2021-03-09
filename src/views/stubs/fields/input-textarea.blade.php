<div class="field no-bg">
    <label>{{$input->title}}</label>
    <textarea name="{{$input->field_name }}" class="form-control"
           placeholder="{{$input->placeholder}}"
           @if($input->required)required="required"@endif>{{ $input->field_value }}</textarea>
</div>
