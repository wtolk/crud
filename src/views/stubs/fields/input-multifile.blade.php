<div class="field">
    <label>{{$input->title}}</label>
    <div data-field-name="{{$input->field_name_dotted }}"></div>
</div>

<script>
    var uploader = new WtolkUploader({
        el: '[data-field-name="{!! $input->field_name_dotted !!}"]',
        input_name: "{{$input->field_name }}[files][]",
        field_name: "{{$input->field_name }}",
        preview: false,
        files: {!!  $input->field_value->toJson()!!}
    });
</script>
