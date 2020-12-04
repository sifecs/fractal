<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.add', compact('permissions') );
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
            'name' => 'required|string|max:50|unique:roles',
            'display_name' => 'nullable|max:100',
            'description' => 'nullable|string|max:200',
            'permission' => 'array|required',
            'permission.*' => 'string|exists:permissions,id',
        ]);

        $role = Role::create($validDate);
        $role->attachPermissions($validDate['permission']);

        return redirect()->route('roles.index')->with('success', 'Роль успешно создана');
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
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
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
            'name' => ['required', 'string', 'max:50', Rule::unique('roles')->ignore($id)],
            'display_name' => 'nullable|max:100',
            'description' => 'nullable|string|max:200',
            'permission' => 'array',
            'permission.*' => 'required|string|exists:permissions,id',
//            'nameLocal.ru' => 'required|string|max:50|min:3',
//            'nameLocal*' => 'string|max:50',
//            'parent_id' => 'integer|nullable|exists:categories,id',
        ]);

        $role = Role::find($id);
        $role->update($validDate);
        $role->setPermissions($validDate['permission']);

        return redirect()->route('roles.index')->with('success', 'Роль успешно от редактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Роль успешно удалена');
    }
}
