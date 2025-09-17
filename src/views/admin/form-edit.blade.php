@extends('crud::admin.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col col-xs-12">
                <div class="box">
                    <div class="page-title">
                        <h1>{{$form->title}}</h1>
                    </div>
                    


                    <div class="box-body form">
                        <form method="POST" data-controller="form" id="main-form" action="{{$form->route}}" role="form" enctype="multipart/form-data" autocomplete="off">
                        @if($form->isModelExists) @method('PATCH') @endif
                        @csrf
                        @foreach($form->columns as $column)
                            {!! $column !!}
                        @endforeach
                        </form>

                        <div class="row flex flex-align-center">
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
