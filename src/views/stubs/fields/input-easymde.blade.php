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
<script src="/vendor/wtolk/crud/elfinder/js/elfinder.min.js"></script>
<script src="/vendor/wtolk/crud/elfinder/js/i18n/elfinder.ru.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

<script>
    const easymde = new EasyMDE({
        element: document.querySelector('textarea[data-field="{{$input->field_name_dotted }}"]'),
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', 'image', 'table', '|',
            'code', 'guide', 'preview', 'side-by-side', 'fullscreen', '|',
            {
                name: "elfinder",
                action: function customElfinder(editor) {
                    // открываешь elFinder (например, во встроенном диалоге)
                    $('<div/>').dialogelfinder({
                        url: "{{ route('adfm.elfinder.route') }}", // твой бекенд-коннектор
                        lang: 'ru',
                        width: 840,
                        height: 850,
                        getFileCallback: function (file) {
                            // file.url – ссылка на файл
                            const cm = editor.codemirror;
                            const selected = cm.getSelection();
                            const markdown = file.mime.startsWith('image/')
                                ? `![${selected || 'image'}](${file.url})`
                                : `[${selected || file.name}](${file.url})`;
                            cm.replaceSelection(markdown);
                        }
                    });
                },
                className: "fa fa-folder-open",
                title: "Вставить из файлового менеджера"
            }
        ]
    });
</script>
