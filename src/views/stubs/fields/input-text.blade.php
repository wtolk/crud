<div class="field">
    <label>{{$input->title}}</label>
    <input type="{{$input->type}}" name="{{$input->field_name }}" class="form-control"
           value="{{ $input->field_value }}" placeholder="{{$input->placeholder}}"
           @if($input->required)required="required"@endif>
</div>
