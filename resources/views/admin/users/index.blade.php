@extends('adminlte::page')

@section('title', 'Список пользователей')

@section('content_header')
    <h1>Список пользователей</h1>
@endsection

@section('content')
    <a href="{{route('users.create')}}" style="max-width: 300px" class="btn btn-block btn-info my-3">Создание пользователя</a>
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список пользователей</h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>роли у пользователя</th>
                    <th>Email</th>
                    <th>status</th>
                    <th>Инструменты</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{ implode(', ', $user->roles->pluck('name')->toArray() )}}</td>
                        <td>{{$user->email}}</td>
                        <td> <input type="checkbox" disabled name="status" value="1" @if($user->status) checked @endif data-bootstrap-switch data-off-color="danger"  data-on-color="success" class="form-control"></td>
                        <td>
                            <span>
                                {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                                <button type="submit" class="delete btn p-0">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </button>
                                {{Form::close()}}
                            </span>
                            <span class="ml-3">
                                <a href="{{route('users.edit', $user->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>роли у пользователя</th>
                        <th>Email</th>
                        <th>status</th>
                        <th>Инструменты</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    </script>
@stop
