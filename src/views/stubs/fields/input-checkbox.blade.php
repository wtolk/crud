<div class="field">
    <label></label>
    <input type="hidden" name="{{$input->field_name }}" value="0" />
    <input type="{{$input->type}}" @if($input->required)required="required"@endif name="{{$input->field_name }}"
           value="1" @if( $input->field_value) checked @endif>
    {{$input->title}}
</div>
