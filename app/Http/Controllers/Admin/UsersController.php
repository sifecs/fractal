<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Locale;
use App\Role;
use App\translation_key;
use App\translations;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id');
        $countries = Country::pluck('name','id');

        $categories = [];
        $categoriesRoot = app('rinvex.categories.category')->get()->toTree();
        function traverse($categoriesRoot, &$categories) {
            foreach ($categoriesRoot as $category) {
                if ($category->children->isEmpty()) {
                    $categories[$category->id] = $category->name;
                }

                if ($category->children->isEmpty()) {
                    traverse($category->children, $categories[$category->id]);
                } else {
                    traverse($category->children, $categories[$category->name]);
                }
            }
        };
        traverse($categoriesRoot, $categories);

        return view('admin.users.add', compact('roles', 'categories', 'countries'));
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:users',
            'password' => 'required|max:80|min:8|confirmed',
            'status' => 'nullable|boolean',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id|nullable',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id|nullable',
            'country_id'  => 'required|exists:countries,id'
        ]);

        if (array_key_exists('status', $validDate)) {
            $validDate['status'] = 1;
        } else {
            $validDate['status'] = 0;
        }
        if (!array_key_exists('roles', $validDate)) {
            $validDate['roles'] = [];
        }
        if (!array_key_exists('categories', $validDate)) {
            $validDate['categories'] = [];
        }
        $validDate['password'] = bcrypt($validDate['password']);
        $user = User::create($validDate);
        $user->roles()->attach($validDate['roles']);
        $user->purchase()->attach($validDate['categories']);

        return redirect()->route('users.index')->with('success', 'Пользователь успешно создан');
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

        $categories = [];
        $categoriesRoot = app('rinvex.categories.category')->get()->toTree();
        function traverse($categoriesRoot, &$categories) {
            foreach ($categoriesRoot as $category) {
                if ($category->children->isEmpty()) {
                    $categories[$category->id] = $category->name;
                }

                if ($category->children->isEmpty()) {
                    traverse($category->children, $categories[$category->id]);
                } else {
                    traverse($category->children, $categories[$category->name]);
                }
            }
        };
        traverse($categoriesRoot, $categories);

        $user = User::find($id);
        $companies = $user->companies;
        $roles = Role::pluck('name', 'id');
        $countries = Country::pluck('name','id');
        return view('admin.users.edit', compact('user','roles', 'categories', 'countries', 'companies'));
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
            'name' => 'required|string|max:50',
            'email' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|max:80|min:8|confirmed',
            'status' => 'nullable|boolean',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id|nullable',
            'country_id'  => 'required|exists:countries,id'
        ]);

        if (array_key_exists('status', $validDate)) {
            $validDate['status'] = 1;
        } else {
            $validDate['status'] = 0;
        }

        if (!array_key_exists('roles', $validDate)) {
            $validDate['roles'] = [];
        }

        if (!array_key_exists('categories', $validDate)) {
            $validDate['categories'] = [];
        }

        if ($validDate['password'] != null) {
            $validDate['password'] = bcrypt( $validDate['password']);
        } else {
            unset($validDate['password']);
        }

        $user = User::find($id);
        $user->update($validDate);
        $user->setRoles($validDate['roles']);
        $user->setPurchase($validDate['categories']);

        return redirect()->route('users.index')->with('success', 'Пользователь успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален');
    }
}
