<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
              class="form-control"
              placeholder="{{$input->placeholder}}"
              id="{{ str_replace(['[', ']'], '_', $input->field_name) }}">{{ $input->field_value }}</textarea>
</div>


<div id="milkdown-container-{{ str_replace(['[', ']'], '_', $input->field_name) }}" ></div>

@vite('resources/js/milkdown-editor.js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textareaId = '{{ str_replace(['[', ']'], '_', $input->field_name) }}';
        const milkdownId = 'milkdown-container-' + textareaId;
        const markdownText = document.getElementById(textareaId).value;
        initMilkdown(textareaId, milkdownId, markdownText);
    });
</script>