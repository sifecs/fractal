<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $slug, $a = null) {
        $cat = app('rinvex.categories.category');

        $category = Category::where('slug', $slug)->firstOrFail();
        $ancestors = $category->getAncestors(['name','slug']);

        if ($category->price &&  $category->children->isEmpty() && ( !\Auth::check() || !\Auth::user()->purchase->find($category->id)) ) {
            return view('pages.category.categoryClose', compact('ancestors', 'category'));
        }

        $categoriesRoot = $cat->descendantsOf($category->id)->toTree();
        $companies = $category->entries(\App\Company::class)->whereHas('user', function (Builder $query) {
            $query  ->where('status', 1)
                    ->where('country_id', \Auth::user()->country->id ?? session()->get('country', Country::first())->id );
        })->where('status', 1)->paginate(1);

        return view('pages.category', compact('categoriesRoot', 'companies', 'ancestors', 'category') );
    }

}
