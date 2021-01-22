@php /** @var Wtolk\Crud\Form\Model $input */ @endphp
<div class="field">
    <label>{{$input->title}}</label>
    <input data-field="{{$input->field_name_dotted }}" type="file" onchange="previewFile()" accept="image/*"><br>
    <input type="hidden" name="{{$input->field_name }}[cropper_base64]" value="" />
    <input type="hidden" name="{{$input->field_name }}[original_name]" value="" />

    <img id="preview" data-field="{{$input->field_name_dotted }}" src="@if($input->field_value){{$input->field_value->getUrl()}}@endif">

</div>

<div data-field="{{$input->field_name_dotted }}" class="hystmodal" id="CropModal" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div data-hystclose class="hystmodal__close">Закрыть</div>
            <img id="image" data-field="{{$input->field_name_dotted }}" src="" alt="Image preview...">
            <div class="button save">Сохранить</div>
        </div>
    </div>
</div>

<script>
    save = document.querySelector('.save');

    save.addEventListener('click',(e)=>{
        e.preventDefault();
        let imgSrc = window.cropper.getCroppedCanvas({
            // width: img_w.value // input value
        }).toDataURL();
        let preview_basic = document.querySelector('#preview[data-field="{{$input->field_name_dotted }}"]');
        console.log(preview_basic);
        let fileInput = document.querySelector('input[name="{{$input->field_name }}[cropper_base64]"]');
        fileInput.setAttribute("value", imgSrc);
        preview_basic.setAttribute("src", imgSrc);
        Modal.close('div[data-field="{{$input->field_name_dotted }}"]');
    });

    function previewFile() {
        if (typeof window.cropper !== 'undefined') {
            window.cropper.destroy();
        }
        const preview_modal = document.querySelector('#image[data-field="{{$input->field_name_dotted }}"]');
        const file = document.querySelector('input[data-field="{{$input->field_name_dotted }}"]').files[0];
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            preview_modal.src = reader.result;
            Modal.open('div[data-field="{{$input->field_name_dotted }}"]');
            const image = document.getElementById('image');
            window.cropper = new Cropper(image, {
                dragMode: 'move',
                @if ($input->crop_size)aspectRatio: {{$input->crop_size[0]}} / {{$input->crop_size[1]}},@endif
                viewMode: 0,
            });
            console.log(window.cropper.getImageData(), 'тут');
        }, false);

        if (file) {
            reader.readAsDataURL(file);
            let fileName = document.querySelector('input[name="{{$input->field_name }}[original_name]"]');
            fileName.setAttribute("value", file.name);
        }
    };

    const Modal = new HystModal({
        linkAttributeName: "data-hystmodal",
        //settings (optional). see Configuration
    });


</script>
