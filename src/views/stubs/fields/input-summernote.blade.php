{{--<div class="field">--}}
{{--    <label for="title">{{$input->title}}</label>--}}
{{--    <input type="text" name="{{$input->field_name }}" class="form-control"--}}
{{--           value="{{ $input->field_value }}" placeholder="{{$input->placeholder}}"--}}
{{--           @if($input->required)required="required"@endif>--}}
{{--</div>--}}


<div class="field">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              class="form-control summernote"
              placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>





<script src="/vendor/wtolk/crud/summernote/summernote-lite.js"></script>

<script src="/vendor/wtolk/crud/summernote/lang/summernote-ru-RU.min.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-ext-elfinder.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-file.js"></script>
<script src="/vendor/wtolk/crud/summernote/plugins/summernote-ext-template.js"></script>
<link href="/vendor/wtolk/crud/summernote/summernote-lite.min.css" rel="stylesheet">

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
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'file']],
                ['view', ['fullscreen', 'codeview', 'help', 'template']]
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


</script>
