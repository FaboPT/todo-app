@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::model($item, [
                 'route'=>['task.update',$item->id],
                 'method'=>'PUT',
                 'accept-charset'=>'UTF-8',
                 'class'=>'form-horizontal'
         ])}}


    <div class="row">
        <div class="col-md-2">

            @include('layouts.includes.back_button')
        </div>

        <div class="col-md-8">
            <h2 style="text-align: center"> Edit task: <b>{{$item->name}}</b></h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                {{Form::label('name','Name:',['class'=>'col-lg-1 col-form-label'])}}
                <div class="col-lg-11">
                    {{Form::text('name',null, ['class'=>'form-control','placeholder'=>'Name', 'required'])}}
                </div>
            </div>

            <div class="form-group row">
                {{Form::label('description','Description:',['class'=>'col-lg-1 col-form-label'])}}
                <div class="col-lg-11">
                    {{Form::textarea('description',null, ['class'=>'form-control','placeholder'=>'Description'])}}
                </div>
            </div>


            {{Form::submit('save', ['class'=>'btn btn-outline-primary float-right'])}}
        </div>
    </div>
    {{ Form::close()}}


@stop

