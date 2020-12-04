<?php

namespace App;

use Arr;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'name', 'status',
    ];

//    public function getLocalesFromCache () {
//        if (\Cache::get('locales') == null) {
//            $this->setLocalesCache();
//        }
//        return \Cache::get('locales', []);
//    }
//
//    function setLocalesCache () {
//        $this->deleteLocalesCache();
//        \Cache::set('locales', Locale::where('status', '1')->pluck('name')->toArray(), now()->addDay(30) );
//    }
//
//    function deleteLocalesCache () {
//        \Cache::delete('locales');
//    }

}
