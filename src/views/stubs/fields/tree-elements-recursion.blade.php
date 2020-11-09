<ol class="dd-list">
    @foreach($items as $item)
        <li class="dd-item" data-id="{{$item->id}}" >
            <div class="dd-handle"> </div>
            <div class="dd-content">
                @if ($input->link)
                    <div class="dd-edit">
                        {{($input->link)($item)}}
                    </div>
                @endif
                {{$item->title}}
            </div>
            @if(count($item->children) > 0)
                @include('crud::stubs.fields.tree-elements-recursion', ['items' => $item->children, 'input' => $input])
            @endif
        </li>
    @endforeach
</ol>
