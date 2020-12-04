@foreach($cats as $cat)

    <option value="{{$cat->id}}" @isset($parent_id) @if($parent_id && $parent_id == $cat->id ) selected @endif @endisset> {!! $delimiter , $cat->name !!}  </option>

    @if (!$cat->children->isEmpty())
        @include('inc.categoriesOptionLeyOut', ['cats' => $cat->children, 'delimiter' => '-' . $delimiter ?? '' , 'parent_id' => $parent_id ?? '' ])
    @endif

@endforeach
