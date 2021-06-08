<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              class="form-control tinymce"
              placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css"/>

<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/theme.css">
<script src="/vendor/wtolk/crud/elfinder/js/elfinder.min.js"></script>
<script src="/vendor/wtolk/crud/elfinder/js/i18n/elfinder.ru.js"></script>

<script src="https://cdn.tiny.cloud/1/908siadknxjfk5ddp3s2p32uvpzcjshrwsisq45hnnokbxyr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript" src="https://nao-pon.github.io/tinymceElfinder/tinymceElfinder.js"></script>

<script>
    $(function(){
        const mceElf = new tinymceElfinder({
            // connector URL (Set your connector)
            url: "{{ route('adfm.elfinder.route') }}",
            lang : 'ru',
            // upload target folder hash for this tinyMCE
            // uploadTargetHash: 'l1_lw', // Hash value on elFinder of writable folder
            // elFinder dialog node id
            nodeId: 'elfinder' // Any ID you decide
        });

        tinymce.init({
            selector: '.tinymce',
            plugins: 'code table lists image imagetools',
            toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image',
            toolbar2: 'table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            language: 'ru',
            file_picker_callback : mceElf.browser,
            images_upload_handler: mceElf.uploadHandler
        });

    });
</script>
