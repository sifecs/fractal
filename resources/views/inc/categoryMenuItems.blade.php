<ul class="list2b">
@foreach($categoriesRoot as $category)

        <li class="d-flex" style="justify-content: space-between">
            <div>
                {{$category->name}}
            </div>
            <div class="">
                <span class="">
                    @if($category->children->isEmpty())


                        {{Form::open(['route'=>['category.destroy', $category->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}
                        <button type="submit" class="delete btn p-0">
                            <i class="fa fa-fw fa-times-circle text-danger"></i>
                        </button>
                        {{Form::close()}}
                    @else
                        <i class="fa fa-fw fa-times-circle"></i>
                    @endif
                </span>
                <span class="ml-3"> <a href="{{route('category.edit', $category->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a> </span>
            </div>
        </li>

        @if (!$category->children->isEmpty())
            <ul class="">
                @include('inc.categoryMenuItems', ['categoriesRoot' => $category->children, 'delimiter' => '-' . $delimiter])
{{--                    <div class="ml-4">@include('inc.categoryMenuItems', ['categoriesRoot' => $category->children, 'delimiter' => '-' . $delimiter])</div>--}}

            </ul>
        @endif


{{--    <div class="list-group-item position-relative">--}}
{{--        <a class="" href="#">{!! $delimiter , $category->name!!}</a>--}}
{{--        <div class="position-absolute" style="right: 20px">--}}
{{--            <span class="">--}}
{{--                @if($category->children->isEmpty())--}}
{{--                    <a href="#" class="delete">--}}
{{--                        <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <i class="fa fa-fw fa-times-circle"></i>--}}
{{--                @endif--}}
{{--            </span>--}}
{{--            <span> <a href="#"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a> </span>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @dump($category->name)--}}

{{--    @if (!$category->children->isEmpty())--}}
{{--        <div class="list-group">--}}
{{--            @include('inc.categoryMenuItems', ['categoriesRoot' => $category->children, 'delimiter' => '-' . $delimiter])--}}
{{--            <div class="ml-4">@include('inc.categoryMenuItems', ['categoriesRoot' => $category->children, 'delimiter' => '-' . $delimiter])</div>--}}

{{--        </div>--}}
{{--    @endif--}}

@endforeach
</ul>
