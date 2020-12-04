<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function index() {
        $categories = \Auth::user()->companies;
        $user = \Auth::user();
        $countries = Country::pluck('name','id');
        return view('pages.profile', compact('categories', 'user', 'countries'));
    }

    public function update(Request $request) {
        $validDate = $this->validate($request,[
            'name' => 'required|string|max:50',
            'email' => ['required', 'string', 'max:50', Rule::unique('users')->ignore(\Auth::id())],
            'password' => 'nullable|max:80|min:8|confirmed',
            'country_id'  => 'required|exists:countries,id'
        ]);

        if ($validDate['password'] != null) {
            $validDate['password'] = bcrypt( $validDate['password']);
        } else {
            unset($validDate['password']);
        }

        $user = \Auth::user();
        $user->update($validDate);
        return redirect()->back()->with('success', 'Профиль успешно обновлён');
    }
}
