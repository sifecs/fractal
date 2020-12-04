@extends('adminlte::page')

@section('title', 'Создание категории')

@section('content_header')
    <h1>Создание категории</h1>
@endsection

@section('content')

    @include('errorMessage')

    {{ Form::open([
        'route'=>['category.store'],
        'method'=>'post',
        'files' => true
        ])
    }}
        <div class="card card-primary">
            <div class="card-body">

                <div class="form-group mb-4 ">

                    <div class="form-group mb-4 row">
                        <span class="text-danger col-12">обезательное поле</span>
                        <div class="col-6">
                            <input type="text" name="nameLocal[ru]" placeholder="Ведите название категории на русском" value="{{ old('nameLocal.ru') }}" class="form-control @error('nameLocal.ru') is-invalid @enderror">
                            @error('nameLocal.ru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <select class="form-control col-6 mb-3"  name="parent_id">
                            <option selected value="">-- Корневая категории --</option>
                            @include('inc.categoriesOptionLeyOut', ['cats' => $categoriesRoot, 'delimiter' => '-'])
                        </select>

                            <div class="form-group">
                                <span>Если цена не указана то категория будет достпна всем</span>
                                <input type="number" name="price" placeholder="Введите цену" class="form-control">
                            </div>

                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">Переводы (Не обезательно)</div>
                        @foreach($locales as $local)
                             @if($local != 'ru')
                                <div class="mb-4 col-sm-4">
                                    <input type="text" name="nameLocal[{{$local}}]" value="{{ old("nameLocal.$local") }}" placeholder="на {{$local}}" class="form-control">
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>

        <a href="{{route('category.index')}}" class="btn btn-secondary">Назад</a>
        <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop

