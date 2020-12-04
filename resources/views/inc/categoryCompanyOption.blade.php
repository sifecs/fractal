@foreach($cats as $cat)

    <option @if(!$cat->children->isEmpty()) disabled @endif value="{{$cat->id}}"
            @isset($parent_id) @if($parent_id && $parent_id == $cat->id ) selected @endif @endisset>
        {!! $delimiter , $cat->name !!}
    </option>

    @if (!$cat->children->isEmpty())
        @include('inc.categoryCompanyOption', ['cats' => $cat->children, 'delimiter' => '-' . $delimiter ?? '' , 'parent_id' => $parent_id ?? '' ])
    @endif

@endforeach
