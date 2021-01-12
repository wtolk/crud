@php /** @var Wtolk\Crud\Form\Model $input */ @endphp
<div class="field no-bg">
    <label>{{$input->title}}</label>
    <input type="{{$input->type}}" name="{{$input->field_name }}"
           value="{{ $input->field_value }}" placeholder="{{$input->placeholder}}"
           @if($input->required)required="required"@endif>
</div>

{{--<div data-field="{{$input->field_name_dotted }}" class="hystmodal" id="CropModal" aria-hidden="true">--}}
{{--    <div class="hystmodal__wrap">--}}
{{--        <div class="hystmodal__window" role="dialog" aria-modal="true">--}}
{{--            <div data-hystclose class="hystmodal__close">Закрыть</div>--}}
{{--            <img id="image" data-field="{{$input->field_name_dotted }}" src="" alt="Image preview...">--}}
{{--            <div class="button save">Сохранить</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<script>
$(function() {
    $('input[name="{{$input->field_name }}"]').flatpickr(
        {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        }
    );
});
</script>
