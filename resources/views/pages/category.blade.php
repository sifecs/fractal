@extends('pages.leyOut')

@section('content')
    @include('pages.inc.categoryBreadCrumbs')

    <div class="container">
        @if(!$categoriesRoot->isEmpty())
            <ul>
                @foreach($categoriesRoot as $category)
                  <li> <a href="{{route('category', [$category->slug])}}"> {{$category->name}} </a></li>
                @endforeach
            </ul>
        @else
            @if(!$companies->isEmpty())
                <ul>
                    @foreach($companies as $company)
                        <li> {{$company->title}} </li>
                    @endforeach
                </ul>
                {{$companies->links()}}
            @endif
            <div class="text-center"> <a href="{{route('categoryFront.create',  [$category->slug])}}" class="btn btn-primary"> Участвовать в рейтинге </a> </div>
        @endif
    </div>
@endsection
