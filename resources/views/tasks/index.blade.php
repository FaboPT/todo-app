@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8" style="align-content: center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        To Do List
                    </h3>

                    <div class="card-tools">
                        <a href="" type="button" class="btn btn-outline-primary float-right "
                           onclick="$('.modal-task-name').text('Create new task');" data-toggle="modal"
                           data-target="#addTaskModal">
                            <i class="fas fa-plus"></i>
                            Add item
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        @foreach($items as $item)
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div  class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" class="check_todo" value="{{$item->id}}" name="todo_{{$item->id}}" id="todoCheck_{{$item->id}}"  @if($item->status == 1) checked @endif>
                                    <label for="todoCheck_{{$item->id}}"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">{{$item->name}}</span>
                                <small class="text-gray">{{$item->description ? : ''}}</small>
                                @if($item->status === 1 && $item->done_at)
                                    <small class="badge badge-success"><i class="fas fa-check-square"></i> {{$item->done_at}}</small>
                                @endif
                                <!-- Emphasis label -->
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <a href="{{route('task.edit',$item->id)}}" data-widget="edit" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <a href=""
                                       data-task-name="{{$item->name}}" data-trid="{{$item->id}}" onclick="$('.modal-task-name').text($(this).data('task-name'));
                                            $('#delete-task').data('trid', $(this).data('trid'))" data-toggle="modal"
                                       data-target="#deleteTaskModal"><i class="fas fa-trash text-danger"></i>
                                    </a>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>

    <!-- Modal add Task -->
    <div class="modal fade" id="addTaskModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modal-task-name"></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{ Form::open([
                                    'route'=>'task.store',
                                    'method'=>'POST',
                                    'accept-charset'=>'UTF-8',
                                    'class'=>'form-horizontal'
                            ])}}

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

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Create task</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Modal delete Task -->
    <div class="modal" id="deleteTaskModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modal-task-name"></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <h5>You want delete this task!</h5>
                    <h5>Are you sure?</h5>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-danger" id="delete-task">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script>
        $("#delete-task").on("click", function () {

            let trid = $(this).data('trid');

            if (trid) {
                $.ajax({
                    type: "DELETE",
                    url: "/tasks/" + trid,
                    data: {
                        _token: "{{csrf_token()}}"
                    }
                })
                    .done(function () {
                        location.reload();
                    })
                    .fail(function () {
                        alert("error");
                    })
            } else {
                alert("error");
            }

        });
    </script>

    <script>
        $('.check_todo').on('click', function () {
            let isChecked = $(this).is(':checked');
            let taskId = $(this).val();
            if (taskId) {
                $.ajax({
                    type: "PUT",
                    url: "/tasks/set-status/" + taskId,
                    data: {
                        status: isChecked ? 1 : 0,
                        done_at: isChecked ? "{{\Carbon\Carbon::now()}}" : null,
                        _token: "{{csrf_token()}}"
                    }
                })
                    .done(function () {
                        location.reload();
                    })
                    .fail(function () {
                        alert("error");
                    })
            } else {
                alert("Not status defined");
            }
        });
    </script>



@endsection
