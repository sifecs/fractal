<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create(Request $request, $slug) {
        if(\Auth::user()->hasVerifiedEmail()) {
            $category = Category::where('slug', $slug)->firstOrFail();
            $ancestors = $category->getAncestors(['name', 'slug']);
            $userCompanies = \Auth::user()->companies;
            $fields = Company::fields();
            return view('pages.company.addCompany', compact('userCompanies', 'ancestors', 'category', 'fields'));
        } else{
            return view('auth.verify');
        }
    }

    public function store(Request $request) {

        $roles = [
            'title' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
        ];
        foreach (Company::fields() as $key => $value) {
            $roles[$key] = 'nullable|integer|min:0|max:50';
        }

        $validDate = $this->validate($request,$roles);


        $categoryId = $validDate['category'];
        unset($validDate['category']);

        $validDate['rating'] = array_sum($validDate);
        $validDate['user_id'] = \Auth::id();

        $category = Category::findOrFail($categoryId);
        if ($category->children->isEmpty()) {
            $company = Company::create($validDate);
            $company->syncCategories($categoryId);
            return redirect()->back()->with('success', 'компания успешно создана');
        }
        return redirect()->back()->with('error', 'Ошибка');
    }

    public function edit(Request $request, $id) {

        $company = \Auth::user()->companies()->findOrFail($id);
        $fields = Company::fields();

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

        return view('pages.company.edit', compact('company','categories', 'fields'));
    }

    public function update(Request $request, $id) {
        $roles = [
            'title' => 'required|string|max:100',
            'category' => 'required|exists:categories,id',
        ];
        foreach (Company::fields() as $key => $value) {
            $roles[$key] = 'nullable|integer|min:0|max:50';
        }

        $validDate = $this->validate($request,$roles);

        $company = \Auth::user()->companies()->findOrFail($id);

        $categoryId = $validDate['category'];
        unset($validDate['category']);
        $validDate['rating'] = array_sum($validDate);

        $category =  app('rinvex.categories.category')->find($categoryId);

        if ($category->children->isEmpty()) {
            $company->update($validDate);
            $company->syncCategories($categoryId);
            return redirect()->back()->with('success', 'компания успешно обновлена');
        }
        return redirect()->back()->with('error', 'Не верно указана категория');
    }

    public function destroy($id) {
        $company = \Auth::user()->companies()->findOrFail($id);
        $company->delete();
        return redirect()->back()->with('success', 'компания успешно удалена');
    }
}
