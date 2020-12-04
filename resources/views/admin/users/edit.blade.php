@extends('adminlte::page')

@section('title', 'Редактирование пользователя')

@section('content_header')
    <h1>Редактирование пользователя</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['users.update', $user->id],
        'method'=>'put',
        ])
    }}

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование пользователя</h3>
        </div>
        <div class="card-body">

            <div class="form-group row">

                <div class="form-group col-6">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите имя" value="{{ $user->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Введите email" value="{{$user->email }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" placeholder="Введите пароль" value="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Введите пароль" value="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label>Выберите разрешение для роли</label>
                    {!! Form::select('roles[]', $roles, $user->roles->pluck('id')->all() ,['multiple' => true, 'class' => 'form-control']); !!}
                </div>

                <div class="form-group col-6">
                    <label>Предоставить доступ к категориям</label>
                    {!! Form::select('categories[]', $categories,  $user->purchase->pluck('id')->all(),['multiple' => true,'class' => 'form-control']); !!}
                </div>

                <div class="form-group col-12">
                    <label>Выберите страну для пользователя</label>
                    {!! Form::select('country_id', $countries, $user->country_id, ['class' => 'form-control']); !!}
                </div>

                <div class="form-group col-12">
                    <span class="mr-3"><strong>статус </strong></span>
                    <input type="checkbox" name="status" value="1" @if($user->status) checked @endif data-bootstrap-switch data-off-color="danger"  data-on-color="success" class="form-control">
                </div>
            </div>



    <a href="{{route('users.index')}}" class="btn btn-secondary">Назад</a>
    <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}

            @if(!$companies->isEmpty())
                <h3 class="mt-4">Компании этого пользователя</h3>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Категория</th>
                        <th>Рейтинг</th>
                        <th>Инструменты</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{$company->id}}</td>
                            <td>{{$company->title}}</td>
                            <td>
                                {{$company->categories->first()->name ?? 'нет категории'}}
                            </td>
                             <td>{{$company->rating}}</td>
                            <td>
                            <span>
                                {{Form::open(['route'=>['company.destroy', $company->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                                <button type="submit" class="delete btn p-0">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </button>
                                {{Form::close()}}
                            </span>
                                <span class="ml-3">
                                <a href="{{route('company.edit', $company->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Категория</th>
                        <th>Рейтинг</th>
                        <th>Инструменты</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <h3 class="mt-4">У этого пользователя нет компаний</h3>
            @endif

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
