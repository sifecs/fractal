<?php

use App\Services\Localization\LocalizationService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ['prefix' => LocalizationService::locale(), 'middleware' => 'setLocale'], // dinamic prefix https://www.youtube.com/watch?v=q5tEjG56a50
    function () {
        Route::get('/', 'HomeController@index');
        Route::get('/category/{slugCategory}', 'CategoryController@index')->name('category')->middleware('password.confirm');

        Route::redirect('/company', '/'); // листинг всех компаний

        Route::get('/company/{slugCategory}/create', 'CompanyController@create')->name('categoryFront.create')->middleware('auth');

        Route::post('/company', 'CompanyController@store')->name('categoryFront.store')->middleware('auth');

//        Route::get('/company/{id}/edit', 'CompanyController@edit')->name('categoryFront.edit')->middleware('auth');
//        Route::put('/company/{id}', 'CompanyController@update')->name('categoryFront.update')->middleware('auth');
//        Route::delete('/company/{id}', 'CompanyController@destroy')->name('companyFront.destroy')->middleware('auth');


//        Route::get('/profile', 'ProfileController@index')->middleware(['verified', 'auth'])->name('profile');
//        Route::put('/profile', 'ProfileController@update')->middleware(['verified', 'auth'])->name('profile.update');



        Route::get('/changeCountry/{id}', 'CountryController@changeCountry')->name('changeCountryAjax');

        Auth::routes(['verify' => true]);
    });

Route::group(['prefix'=> LocalizationService::locale() . '/admin','namespace'=>'Admin', 'middleware'	=>	['auth', 'setLocale', 'permission:admin_panel']], function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('category', 'CategoryController', ['middleware' => ['permission:categories_control']])->names('category');
    Route::resource('/locale', 'LocaleController', ['middleware' => ['permission:locales_control']])->names('locale');
    Route::resource('/roles', 'RolesController', ['middleware' => ['permission:roles_control']])->names('roles');
    Route::resource('/users', 'UsersController', ['middleware' => ['permission:users_control']])->names('users');
    Route::resource('/company', 'CompanyController',['middleware' => ['permission:company_control']])->names('company');
    Route::resource('/country', 'CountryController')->names('country');
    Route::get('/resetCacheLocale', 'LocalesCacheController@resetCache')->name('cacheLocale.reset');
});

//Route::get('/home', function() {
//    return view('home');
//})->name('home')->middleware('auth');
