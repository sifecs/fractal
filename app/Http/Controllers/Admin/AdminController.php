<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Localization\LocalizationService;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\AdminLte;

class AdminController extends Controller
{
    public function index() {
//        $a = LocalizationService::locale();
//
//        $getLocale = \App::getLocale();
//        dd($getLocale, $a);


//        return view('admin.auth.login');
        return view('admin.index.index');
    }
}
