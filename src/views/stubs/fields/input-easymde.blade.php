<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              data-field="{{$input->field_name_dotted }}"
              class="form-control easymde"
              placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>



<link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css"
/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/wtolk/crud/elfinder/css/theme.css">
<script src="/vendor/wtolk/crud/elfinder/js/elfinder.min.js"></script>
<script src="/vendor/wtolk/crud/elfinder/js/i18n/elfinder.ru.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

<script>
    const easymde = new EasyMDE({
        element: document.querySelector('textarea[data-field="{{$input->field_name_dotted }}"]'),
        spellChecker: false,
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', 'image', 'table', '|',
            'code', 'guide', 'preview', 'side-by-side', 'fullscreen', '|',
            {
                name: "elfinder",
                className: "fa fa-folder-open",
                title: "Вставить из файлового менеджера",
                action: function (editor) {
                    $('<div/>').dialogelfinder({
                        url: "{{ route('adfm.elfinder.route') }}",
                        lang: 'ru',
                        width: 840,
                        height: 850,
                        destroyOnClose: true,
                        getFileCallback: function (file, fm) {
                            const cm = editor.codemirror;
                            let fullUrl = file.url;
                            if (!fullUrl || fullUrl.endsWith('/')) {
                                // убираем лишние слэши
                                fullUrl = file.baseUrl.replace(/\/+$/, '') + '/' + file.path.replace(/^\/+/, '');
                            }
                            const html = (file.mime || '').startsWith('image/')
                                ? '<img src="'+fullUrl+'"  alt=""/>'
                                : '<a href="'+fullUrl+'">'+fullUrl+'</a>';
                            cm.replaceSelection(html);
                            cm.focus();

                            fm.destroy(); // <-- корректно закрывает диалог
                        }
                    });
                }
            }
        ]
    });

</script>
