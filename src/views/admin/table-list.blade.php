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
                        @foreach($form->renderedButtons as $button)
                            {!! $button !!}
                        @endforeach
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
                            <tr>
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


        @foreach($form->renderedButtons as $button)
            {!! $button !!}
        @endforeach

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

@endsection
