<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Locale;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesRoot = app('rinvex.categories.category')->get()->toTree();
//dd(config('rinvex.categories.tables.categories'));
        return view('admin.category.index', compact('categoriesRoot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Locale::pluck('name')->toArray();
        $categoriesRoot = app('rinvex.categories.category')->get()->toTree();

        return view('admin.category.add', compact('locales', 'categoriesRoot'));
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
            'nameLocal' => 'array',
            'nameLocal.ru' => 'required|string|max:50|min:3',
            'nameLocal.*' => 'string|max:50|nullable',
            'parent_id' => 'integer|nullable|exists:categories,id',
            'img' => 'required|image',
            'price' => 'nullable|integer',
        ]);

        $cat = app('rinvex.categories.category');
        $parentCategory = $cat->find($validDate['parent_id']);
        if ($parentCategory != null) {
            $children = $parentCategory->descendants()->withDepth()->having('depth', '1')->get();

            foreach ($children as $child) {
                if ($child->getTranslation('name', 'ru') == $validDate['nameLocal']['ru']) {
                    return redirect()->back()->withErrors('Эта категорию в этом разделе уже существует');
                }
            }

            if (!$parentCategory->entries(\App\Company::class)->get()->isEmpty()) {
                return redirect()->back()->withErrors('В эта категорию есть компании');
            }
        }

        $namesCategories = array_diff($validDate['nameLocal'], [null, '', false, 0]);

        $newCategory = $cat->create([
            'name' => $namesCategories,
            'price' => $validDate['price']
        ], $parentCategory);
        $newCategory->uploadImg($validDate['img']);
        return redirect()->route('category.index')->with('success', 'Категория успешно создана');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('ПОказать', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = app('rinvex.categories.category');

        $categoriesRoot = $cat->get()->toTree();
        $category =  $cat->find($id);
        $locales = Locale::pluck('name')->toArray();
        $companies = $category->entries(\App\Company::class)->get();

        return view('admin.category.edit', compact('locales', 'categoriesRoot', 'category', 'companies'));
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
            'nameLocal' => 'array',
            'nameLocal.ru' => 'required|string|max:50|min:3',
            'nameLocal.*' => 'string|max:50|nullable',
            'parent_id' => 'integer|nullable|exists:categories,id',
            'img' => 'nullable|image',
            'price' => 'nullable|integer'
        ]);

        $cat = app('rinvex.categories.category');
        $parentCategory = $cat->find($validDate['parent_id']);
        $category = $cat->find($id);

        if ($parentCategory != null) {
            $children = $parentCategory->descendants()->withDepth()->having('depth', '1')->get();
            foreach ($children as $child) {
                if ($child->getTranslation('name', 'ru') == $validDate['nameLocal']['ru'] && $child->id != $id ) {
                    return redirect()->back()->withErrors('Эта категорию в этом разделе уже существует');
                }
            }

            if (!$parentCategory->entries(\App\Company::class)->get()->isEmpty()) {
                return redirect()->back()->withErrors('В эта категорию есть компании');
            }
        }


        $namesCategories = array_diff($validDate['nameLocal'], [null, '', false, 0]);

        if ($parentCategory != null) {
            $changeParent = $category->appendToNode($parentCategory)->save();
        } else {
            $changeParent = $category->saveAsRoot();
        }

        $changeName = $category->update([
            'name' => $namesCategories,
            'price' => $validDate['price']
        ]);

        $category->uploadImg($validDate['img'] ?? null);

        if ($changeParent && $changeName) {
            return redirect()->route('category.index')->with('success', 'Категория успешно обновлена');
        }

        return redirect()->route('category.index')->with('error', 'ошибка обновления');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = app('rinvex.categories.category');

        $category = $cat->find($id);
        if ($category != null && $category->children->isEmpty()) {
            $resDelete = $category->delete();
            if ($resDelete) {
                return redirect()->route('category.index')->with('success', 'Категория успешно удалена');
            }
            return redirect()->route('category.index')->with('error', 'Произошла ошибка удаления');
        }

        return redirect()->route('category.index')->with('error', 'Вы не можете удалить эту категорию так как у ней есть вложенные категории');
    }
}
