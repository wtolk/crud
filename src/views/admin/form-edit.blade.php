@extends('crud::admin.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col col-xs-12">



                <div class="box">
                    <div class="page-title">
                        <h1>{{$form->title}}</h1>
                    </div>
                    <div class="box-body">
                        @if($form->isModelExists)
                            <form method="POST" data-controller="form" id="main-form" action="{{$form->route}}" role="form" enctype="multipart/form-data" autocomplete="off">
                            @method('PATCH')
                        @else
                            <form method="POST" data-controller="form" id="main-form" action="{{$form->route}}" role="form" enctype="multipart/form-data" autocomplete="off">
                        @endif
                            @csrf
                            <div class="row">

                                @foreach($form->columns as $column)
                                <div class="{{$column->class}}"> <!-- Первая панель -->
                                    <div class="form">
                                        @foreach($column->renderedFields as $field)
                                            {!! $field !!}
                                        @endforeach

                                    </div>
                                </div>
                                @endforeach
                            </div>
                            </form>

                            <div class="row">
                                @foreach($form->renderedButtons as $button)
                                    {!! $button !!}
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
