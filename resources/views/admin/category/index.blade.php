@extends('adminlte::page')

@section('title', 'Список категорий')

@section('content_header')
    <h1>Список категорий</h1>
@endsection

@section('content')

    <a href="{{route('category.create')}}" style="max-width: 300px" class="btn btn-block btn-info my-3">Добавить категорию</a>
    <p>Welcome to this beautiful admin panel.</p>
    <div class="list-group well">
        @include('inc.categoryMenuItems', ['categoriesRoot' => $categoriesRoot, 'delimiter' => '-'])
    </div>
@endsection


