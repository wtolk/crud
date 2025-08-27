@php /** @var Wtolk\Crud\Form\Model $input */ @endphp
<div class="field no-bg">
    <label>{{$input->title}}</label>
    <input type="{{$input->type}}" name="{{$input->field_name }}"
           value="{{ $input->field_value }}" placeholder="{{$input->placeholder}}"
           @if($input->required)required="required"@endif>
</div>

<script>
    $( document ).ready(function() {
        let calendar = flatpickr('input[name="{{$input->field_name }}"]', {
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
        });
    });
</script>
