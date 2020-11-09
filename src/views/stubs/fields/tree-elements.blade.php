<div class="field">
    <label>{{$input->title}}</label>
    @if($input->field_value)
    <div id="root-list" class="dd">
        <ol class="dd-list">
            @foreach($input->field_value as $menu_item)
                <li class="dd-item" data-id="{{$menu_item->id}}" >
                    <div class="dd-handle"> </div>
                    <div class="dd-content">
                        @if ($input->link)
                            <div class="dd-edit">
                                {{($input->link)($menu_item)}}
                            </div>
                        @endif
                            {{$menu_item->title}}
                    </div>
                    @if(count($menu_item->children) > 0)
                        @include('crud::stubs.fields.tree-elements-recursion', ['items' => $menu_item->children, 'input' => $input])
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    @endif
</div>

<input type="hidden" name="{{$input->field_name }}">

<script src="/vendor/wtolk/crud/js/jquery.nestable.min.js" type="text/javascript"></script>
<script>
    $('#root-list').nestable({
        callback: function(l,e){
            // console.log(JSON.stringify($('.dd').nestable('toArray')));
            document.querySelector('[name="{{$input->field_name }}"]').value = JSON.stringify($('.dd').nestable('toArray'));
            // e is the element that was moved
        }
    });
</script>







<style>
    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: 600px;
        list-style: none;
        font-size: 13px;
        line-height: 20px
    }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none
    }

    .dd-list .dd-list {
        padding-left: 30px
    }

    .dd-empty, .dd-item, .dd-placeholder {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px
    }

    .dd-edit {
        height: 30px;
        width: 30px;
        color: #333;
        text-decoration: none;
        font-weight: 700;
        box-sizing: border-box;
        position: absolute;
        margin: 0;
        left: 28px;
        top: -1px;
        cursor: pointer;
        line-height: 30px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        border: 1px solid #aaa;
        background: #ddd;
        background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: linear-gradient(top, #ddd 0%, #bbb 100%);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        z-index: 999;
    }
    .dd-edit i {
        font-size: 27px;
        color: #000;
    }
    .dd-edit:hover i {
        color: #5237be;
    }
    .dd-handle {
        display: block;
        height: 30px;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        font-weight: 700;
        border-radius: 3px;
        box-sizing: border-box;
        position: absolute;
        margin: 0;
        left: 0;
        top: 0;
        cursor: all-scroll;
        width: 30px;
        text-indent: 30px;
        white-space: nowrap;
        overflow: hidden;
        border: 1px solid #aaa;
        background: #ddd;
        background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: linear-gradient(top, #ddd 0%, #bbb 100%);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        z-index: 999;
    }
    .dd-handle:before {
        content: '≡';
        display: block;
        position: absolute;
        left: 0;
        top: 3px;
        width: 100%;
        text-align: center;
        text-indent: 0;
        color: #fff;
        font-size: 20px;
        font-weight: normal;
    }

    .dd-content {
        display: block;
        height: 30px;
        margin: 5px 0;
        padding: 5px 10px 5px 80px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: linear-gradient(top, #fafafa 0%, #eee 100%);
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .dd-handle:hover {
        color: #2ea8e5;
        background: #fff
    }

    .dd-item > button {
        position: relative;
        cursor: pointer;
        float: left;
        width: 25px;
        height: 20px;
        margin: 5px 0 5px 60px;
        padding: 0;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 0;
        background: 0 0;
        font-size: 12px;
        line-height: 1;
        text-align: center;
        font-weight: 700
    }

    .dd-item > button:before {
        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        text-indent: 0
    }

    .dd-item > button.dd-expand:before {
        content: '+';
        z-index: 999;
    }

    .dd-item > button.dd-collapse:before {
        content: '-';
        z-index: 999;
    }

    .dd-expand {
        display: none
    }

    .dd-collapsed .dd-collapse, .dd-collapsed .dd-list {
        display: none
    }

    .dd-collapsed .dd-expand {
        display: block
    }

    .dd-empty, .dd-placeholder {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box
    }

    .dd-empty {
        border: 1px dashed #bbb;
        min-height: 100px;
        background-color: #e5e5e5;
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px
    }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999
    }

    .dd-dragel > .dd-item .dd-handle {
        margin-top: 0
    }

    .dd-dragel .dd-handle {
        box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1)
    }

    .dd-nochildren .dd-placeholder {
        display: none
    }
</style>
