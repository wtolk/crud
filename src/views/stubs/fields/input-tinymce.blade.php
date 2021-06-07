<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              class="form-control tinymce"
              placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>

<script src="https://cdn.tiny.cloud/1/908siadknxjfk5ddp3s2p32uvpzcjshrwsisq45hnnokbxyr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    $(function(){
        tinymce.init({
            selector: '.tinymce',
            plugins: 'code table lists image',
            toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image',
            toolbar2: 'table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            language: 'ru',
        });
    });
</script>
