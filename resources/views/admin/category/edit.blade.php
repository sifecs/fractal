@extends('adminlte::page')

@section('title', 'Обновление категории')

@section('content_header')
    <h1>Обновление категории</h1>
@endsection

@section('content')
    @include('errorMessage')
    <div class="card card-primary">
        <div class="card-body">
            {{ Form::open([
                'route'=>['category.update', $category->id],
                'method'=>'put',
                'files' => true
                ])
            }}
                <div class="form-group mb-4 ">
                    <div class="form-group mb-4 row">
                        <span class="text-danger col-12">обезательное поле</span>
                        <div class="col-6">
                            <input type="text" name="nameLocal[ru]" placeholder="Ведите название категории на русском" value="{{$category->getTranslation('name', 'ru')}}" class="form-control @error('nameLocal.ru') is-invalid @enderror">
                            @error('nameLocal.ru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <select class="form-control col-6 mb-3"  name="parent_id">
                            <option selected value="">-- Корневая категории --</option>
                            @include('inc.categoriesOptionLeyOut', ['cats' => $categoriesRoot, 'delimiter' => '-', 'parent_id' => $category->parent_id])
                        </select>

                        @if($category->children->isEmpty())
                            <div class="form-group">
                                <span>Если цена не указана то категория будет достпна всем</span>
                                <input type="number" name="price" value="{{$category->price}}" placeholder="Введите цену" class="form-control">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-file mb-3">
                            <input type="file" name="img" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div><img style="max-width: 200px" src="{{$category->getImage()}}"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">Переводы (Не обезательно)</div>
                        @foreach($locales as $local)
                            @if($local != 'ru')
                                <div class="mb-4 col-sm-4">
                                    <input type="text" name="nameLocal[{{$local}}]" placeholder="на {{$local}}" value="{{$category->getTranslations('name')[$local] ?? ''}}" class="form-control">
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <a href="{{route('category.index')}}" class="btn btn-secondary">Назад</a>
                <input type="submit" value="Сохранить" class="btn btn-success float-right">
            {{Form::close()}}
            @if(!$companies->isEmpty())
                <h3 class="mt-4">Компании этой категории</h3>
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
                <h3 class="mt-4">В этой категорий нет компаний</h3>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@stop

