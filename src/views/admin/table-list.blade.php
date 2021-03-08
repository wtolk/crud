@extends('crud::admin.layout', ['form' => $form])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row nomargin">
                    <div class="col col-8">
                        <div class="page-title">
                            <h1>{{$form->title}}</h1>
                        </div>
                    </div>
                    <div class="col col-4 flex flex flex-align-center flex-justify-end">
                        @if(isset($form->renderedButtons))
                            @foreach($form->renderedButtons as $button)
                                {!! $button !!}
                            @endforeach
                        @endif
                        @if(isset($form->renderedFilters))
                            <div style="line-height: 17px;" class="button filter-turn material-icons">filter_alt</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        {{reset($form->source)->links('crud::admin.include.pagination') }}
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach($form->fields as $field)
                                <th>{{$field->title}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(reset($form->source) as $item)
                            <tr class="@if( method_exists($item, 'trashed') && $item->trashed())deleted @endif" >
                                @foreach($form->fields as $field)
                                    <td>

                                        @if ($field->link)
                                            {{($field->link)($item)}}
                                        @else
                                            {{ $item->{$field->field_name} }}
                                        @endif
                                    </td>

                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>


        @if(isset($form->renderedButtons))
            @foreach($form->renderedButtons as $button)
                {!! $button !!}
            @endforeach
        @endif

            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col col-12">
            {{reset($form->source)->links('crud::admin.include.pagination') }}
        </div>
    </div>
</section>
<!-- /.content -->





</section>

@if(isset($form->renderedFilters))
<section id="filter-panel">
    <div class="row">
        <div class="col col-12">
            <div class="page-title">
                <h1>Фильтры</h1>
            </div>
        </div>
        <div class="col col-12">
            <div class="form">
                @if(isset($form->renderedFilters))
                    <form method="GET" action="">
                        @foreach($form->renderedFilters as $filter)
                            {!! $filter !!}
                        @endforeach
                        <div class="field no-bg">
                            <button class="button" type="submit">Фильтровать</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>


    </div>
</section>

<style>
    #filter-panel {
        position: absolute;
        width: 0px;
        background: #fff;
        left: -10px;
        top: 0;
        height: 100vh;
        box-shadow: 0px 16px 24px rgb(0 0 0 / 36%);
        content-visibility: auto;
        border-right: 2px solid #6EA5E4;
    }
</style>

<script>
    $( ".filter-turn" ).click(function() {

        if ( $('#filter-panel').hasClass("active") ) {
            $('#filter-panel').animate({width:"0px"}, 200);
        } else {
            $('#filter-panel').animate({width: '500px'});
        }
        $('#filter-panel').toggleClass("active");
    });
</script>
@endif
@endsection
