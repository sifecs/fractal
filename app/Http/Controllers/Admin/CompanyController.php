<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('categories')->get();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        }
        traverse($categoriesRoot, $categories);

        $fields = Company::fields();

        return view('admin.company.add', compact('categories', 'fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = [
            'title' => 'required|string|max:100',
            'category' => 'required|exists:categories,id',
        ];
        foreach (Company::fields() as $key => $value) {
            $roles[$key] = 'nullable|integer|min:0';
        }

        $validDate = $this->validate($request,$roles);

        $categoryId = $validDate['category'];
        unset($validDate['category']);

        $validDate['rating'] = array_sum($validDate);
        $validDate['user_id'] = \Auth::id();

        $category =  app('rinvex.categories.category')->find($validDate['category']);

        if ($category->children->isEmpty()) {
            $company = Company::create($validDate);
            $company->syncCategories($categoryId);
            return redirect()->route('company.index')->with('success', 'компания успешно создана');
        }

        return redirect()->route('company.index')->with('error', 'Не верно указана категория');
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
        $company = Company::find($id);
        $fields = Company::fields();
        $user = $company->user;
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

        return view('admin.company.edit', compact('company','categories', 'fields', 'user'));
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
        $roles = [
            'title' => 'required|string|max:100',
            'category' => 'required|exists:categories,id',
        ];
        foreach (Company::fields() as $key => $value) {
            $roles[$key] = 'nullable|integer|min:0';
        }

        $validDate = $this->validate($request,$roles);

        $categoryId = $validDate['category'];
        unset($validDate['category']);

        $validDate['rating'] = array_sum($validDate);

        $category =  app('rinvex.categories.category')->find($categoryId);

        if ($category->children->isEmpty()) {
            $company = Company::find($id);
            $company->update($validDate);
            $company->syncCategories($categoryId);
            return redirect()->route('company.index')->with('success', 'компания успешно обновлена');
        }

        return redirect()->route('company.index')->with('error', 'Не верно указана категория');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('company.index')->with('success', 'компания успешно удалена');
    }
}
