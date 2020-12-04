@extends('adminlte::page')

@section('title', 'Список достпуных языков')

@section('content_header')
    <h1>Список достпуных языков</h1>
@endsection

@section('content')
    <a href="{{route('locale.create')}}" style="max-width: 300px" class="btn btn-block btn-info my-3">Добавиление языка перевода</a>
    <p>Welcome to this beautiful admin panel.</p>



    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span>Окаймленный Стол</span></h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Язык</th>
                        <th>Прогресс перевода</th>
                        <th style="width: 20px">активыный</th>
                        <th class="text-center">Инструменты</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($locales as $local)
                        <tr>
                            <td>{{$local->id}}</td>
                            <td class="">{{$local->name}} </td>
                            <td class="">
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="{{'width:' . rand(0,100). '%' }}"> <span class="badge bg-danger">95%</span> </div>
                                </div>
                            </td>

                            <td class="">
                                <span>
                                    <input type="checkbox" name="status" @if($local->status) checked @endif
                                    data-bootstrap-switch data-off-color="danger"  data-on-color="success" disabled>
                                </span>
                            </td>

                            <td class="text-center">
                                <span>
                                    @if($local->id != 1)
                                    {{Form::open(['route'=>['locale.destroy', $local->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                                        <button type="submit" class="delete btn p-0">
                                            <i class="fa fa-fw fa-times-circle text-danger"></i>
                                        </button>
                                    {{Form::close()}}
                                    @endif
                                </span>
                                <span class="ml-3">
                                    <a href="{{route('locale.edit', $local->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('js')
    <script>

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        // $('.my-card').CardWidget('toggle');

        console.log('Hi!');
    </script>
@stop
