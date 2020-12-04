<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Locale;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locales = Locale::all();

        return view('admin.locale.index', compact('locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locale.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validDate = $this->validate($request,[
            'name' => 'required|string|max:5|unique:locales',
            'status' => 'nullable|boolean'
        ]);

        if (array_key_exists('status', $validDate)) {
            $validDate['status'] = 1;
        } else {
            $validDate['status'] = 0;
        }

        $locale = Locale::create($validDate);

        return redirect()->route('locale.index')->with('success', 'Язык перевода успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locale = Locale::find($id);

        return view('admin.locale.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validDate = $this->validate($request,[
            'name' => ['required', 'string', 'max:5', Rule::unique('locales')->ignore($id)],
            'status' => 'nullable|boolean',
        ]);

        $locale = Locale::find($id);

        if ($id != 1) {

            if (array_key_exists('status', $validDate)) {
                $validDate['status'] = 1;
            } else {
                $validDate['status'] = 0;
            }

            $locale->update($validDate);
        }

        return redirect()->route('locale.index')->with('success', 'Язык перевода успешно обновлен');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != 1) {
            $locale = Locale::find($id);
            $localeDelete = $locale->delete();

            if ($localeDelete) {
                return redirect()->route('locale.index')->with('success', 'Язык перевода успешно удален');
            }
            return redirect()->back()->withErrors('Произошла ошибка');
        } else {
            return redirect()->back()->withErrors('вы не можете удалить этот язык');
        }
    }

}
