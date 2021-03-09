<div class="field no-bg">
    <label>{{$input->title}}</label>
    <table>
        @foreach($input->field_value as $key => $value)
            <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    </table>
</div>
