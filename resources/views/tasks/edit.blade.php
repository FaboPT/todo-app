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
    @php html()->model($item) @endphp
    {!! html()->form('PUT', route('task.update', $item->id))->class('form-horizontal')->open() !!}


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
                {!! html()->label('Name:', 'name')->class('col-lg-1 col-form-label') !!}
                <div class="col-lg-11">
                    {!! html()->text('name')->class('form-control')->placeholder('Name')->required() !!}
                </div>
            </div>

            <div class="form-group row">
                {!! html()->label('Description:', 'description')->class('col-lg-1 col-form-label') !!}
                <div class="col-lg-11">
                    {!! html()->textarea('description')->class('form-control')->placeholder('Description') !!}
                </div>
            </div>


            {!! html()->submit('save')->class('btn btn-outline-primary float-right') !!}
        </div>
    </div>
    </form>


@stop

