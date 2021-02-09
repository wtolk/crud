<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              class="form-control summernote"
              placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>



<!-- jQuery and jQuery UI (REQUIRED) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/theme.css">

<script src="/vendor/wtolk/crud/summernote/summernote-lite.js"></script>
<script src="/vendor/wtolk/crud/elfinder/js/elfinder.min.js"></script>
<script src="/vendor/wtolk/crud/elfinder/js/i18n/elfinder.ru.js"></script>

<script src="/vendor/wtolk/crud/summernote/lang/summernote-ru-RU.min.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-ext-elfinder.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-file.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-ext-template.js"></script>
<link href="/vendor/wtolk/crud/summernote/summernote-lite.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>


<script>
    $(function() {
        $('.summernote').summernote({
            height: 200,
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            tabsize: 2,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                // ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video', ['elfinder'], 'file']],
                ['insert', ['link',  'video', 'elfinder']],
                // ['view', ['fullscreen', 'codeview', 'help', 'template']]
                ['view', ['fullscreen', 'codeview',]]
            ],

            template: {
                path: '/vendor/wtolk/crud/summernote/templates', // path to your template folder

                /*
                 * list of your templates
                 * key is the html file name (without .html extension)
                 * value is the label shown in the editor
                 */
                list: {
                    'test': 'Тест',
                    '2column': 'Текст две колонки',
                    '2column-element': 'Вставить элемент во вторую колонку',
                    'test2': 'Таблица'
                }
            },
        });
    });

    // Elfinder Plugin
    function elfinderDialog(context){ // <------------------ +context
        var fm = $('<div/>').dialogelfinder({
            url : "{{ route('adfm.elfinder.route') }}",
            lang : 'ru',
            width : 840,
            height: 450,
            destroyOnClose : true,
            getFileCallback : function(file, fm) {
                // console.log(file);
                // console.log('инсерт');
                // $('.editor').summernote('editor.insertImage', fm.convAbsUrl(file.url)); ...before
                context.invoke('editor.insertImage', fm.convAbsUrl(file.url)); // <------------ after
            },
            commandsOptions : {
                getfile : {
                    oncomplete : 'close',
                    folders : false
                }
            }
        }).dialogelfinder('instance');
    }
</script>
