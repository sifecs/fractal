@extends('adminlte::page')

@section('title', 'Список пользователей')

@section('content_header')
    <h1>Список ролей</h1>
@endsection

@section('content')
    <a href="{{route('roles.create')}}" style="max-width: 300px" class="btn btn-block btn-info my-3">Создание роли</a>
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список ролей</h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>читаемое имя</th>
                    <th>Описание</th>
                    <th>Инструменты</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->display_name}}</td>
                        <td> {{$role->description}} </td>
                        <td>
                            <span>
                                {{Form::open(['route'=>['roles.destroy', $role->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                                <button type="submit" class="delete btn p-0">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </button>
                                {{Form::close()}}
                            </span>
                            <span class="ml-3">
                                <a href="{{route('roles.edit', $role->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>читаемое имя</th>
                        <th>Описание</th>
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
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    </script>
@stop
