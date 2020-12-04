<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Locale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat = app('rinvex.categories.category');
        $categoriesRoot = $cat->get()->toTree();
        $countries = Country::all();
//        dd(app()->getLocale(), __('main.hello'));

        return view('pages.main', compact('categoriesRoot'));
    }
}
