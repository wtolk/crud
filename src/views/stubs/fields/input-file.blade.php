<div class="field">
    <label>{{$input->title}}</label>
    <input type="{{$input->type}}" name="{{$input->field_name }}" class="form-control"
           @if($input->required)required="required"@endif>
</div>
