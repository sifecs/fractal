<?php

namespace App\Http\Controllers;

use App\Country;

class CountryController extends Controller
{
    public function changeCountry( $id) {
        $country = Country::find($id);

        if ($country) {
            session(['country' => $country]);

            if (\Auth::check()) {
               $user  = \Auth::user();
                $user->update(['country_id' => $country->id]);
            }

            return response()->json($country);
        }
        return false;

    }
}
