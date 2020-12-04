@extends('adminlte::page')

@section('title', 'Редактирование компании')

@section('content_header')
    <h1>Редактирование компании</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')



    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование компании</h3>
        </div>
        <div class="card-body">
            {{ Form::open([
                    'route'=>['company.update', $company->id],
                    'method'=>'put',
                ])
            }}
            <div class="form-group mb-4 row">

                <div class="form-group col-12">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Введите  название компании" value="{{ $company->title }}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @foreach($fields as $key => $field)
                    <div class="form-group col-4">
                        <input type="number" name="{{$key}}" class="form-control" placeholder="{{$field}}" value="{{ $company->$key }}">
                    </div>
                @endforeach

                <div class="form-group col-12">
                    <label>Выберите категорию для компании</label>
                    {!! Form::select('category', $categories, $company->categories->pluck('id')->all() ,['class' => 'form-control']); !!}
                </div>

            </div>
            <a href="{{route('company.index')}}" class="btn btn-secondary">Назад</a>
            <input type="submit" value="Сохранить" class="btn btn-success float-right">
            {{Form::close()}}

            <h3 class="mt-4">Пользователь этой компании</h3>
            <table id="example1" class="table table-bordered table-striped mt-4">
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
    </script>
@stop
