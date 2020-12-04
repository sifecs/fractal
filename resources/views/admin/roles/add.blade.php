@extends('adminlte::page')

@section('title', 'Создание новой роли')

@section('content_header')
    <h1>Создание новой роли</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['roles.store'],
        'method'=>'post',
        ])
    }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание новой роли</h3>
        </div>
        <div class="card-body">

            <div class="form-group row">

                <div class="form-group col-6">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите название роли" value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="text" name="display_name" class="form-control @error('display_name') is-invalid @enderror" placeholder="Введите читаемое имя" value="{{ old('display_name') }}">
                    @error('display_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-12">
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Введите описание роли" value="{{ old('description') }}">
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-12">
                    <label>Выберите разрешение для роли</label>
                    {!! Form::select('permission[]', $permissions->pluck('name','id'), null,['multiple' => true, 'class' => 'form-control']); !!}
                    <span>Что значат разрешения </span>
                    @foreach($permissions as $permission)
                        <div class="info text-muted">{{$permission->name}} -- {{$permission->description}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <a href="{{route('roles.index')}}" class="btn btn-secondary">Назад</a>
    <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}

@endsection

@section('js')
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@stop

