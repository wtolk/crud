<div class="field no-bg">
    <label for="title">{{$input->title}}</label>
    <textarea name="{{$input->field_name }}"
            id="laraberg"
            class="form-control"
            placeholder="{{$input->placeholder}}">{{ $input->field_value }}</textarea>
</div>

<script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>

<link rel="stylesheet" href="/vendor/laraberg/css/laraberg.css">
<script src="/vendor/laraberg/js/laraberg.js"></script>

<script>
    Laraberg.init('laraberg');
</script>
