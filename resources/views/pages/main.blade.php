@extends('pages.leyOut')

@section('content')
    <div class="container">
        <h1 class="text-center font-weight-bold">@lang('main.title')</h1>
        <h3 class="text-center">@lang('main.subTitle')</h3>

        <div class="row">
            @foreach($categoriesRoot as $category)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <a class="imgCustom" href="{{route('category', [$category->slug])}}">
                        <img class="card-img-top" src="{{$category->getImage()}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"> <a href="{{route('category', [$category->slug])}}"> {{$category->name}} </a></h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
