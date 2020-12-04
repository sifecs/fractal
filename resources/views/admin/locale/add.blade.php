@extends('adminlte::page')

@section('title', 'Создание нового языка перевода языков')

@section('content_header')
    <h1>Создание нового языка перевода языков</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['locale.store'],
        'method'=>'post',
        ])
    }}
    <div class="card card-primary">
        <div class="card-body">

            <div class="form-group">
                <label class="text-danger">обезательное поле</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите название язык перевода" value="{{ old('name') }}">
                <small class="form-text text-muted">Пример ru, en </small>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger"  data-on-color="success" class="form-control">
            </div>

        </div>
    </div>

    <a href="{{route('locale.index')}}" class="btn btn-secondary">Назад</a>
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

