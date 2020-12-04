@extends('adminlte::page')

@section('title', 'Список стран')

@section('content_header')
    <h1>Список стран</h1>
@endsection

@section('content')
    <a href="{{route('country.create')}}" style="max-width: 300px" class="btn btn-block btn-info my-3">Создание стран</a>
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список стран</h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Инструменты</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{$country->id}}</td>
                        <td>{{$country->name}}</td>
                        <td>
                            <span>
                                {{Form::open(['route'=>['country.destroy', $country->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                                <button type="submit" class="delete btn p-0">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </button>
                                {{Form::close()}}
                            </span>
                            <span class="ml-3">
                                <a href="{{route('country.edit', $country->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Инструменты</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    </script>
@stop
