<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(CategoryRequest $request) {
        $category = $request->only(['name']);
        Category::create($category);
        $message = "カテゴリを作成しました";
        return redirect('/categories')->with(compact('message'));
    }

    public function update(CategoryRequest $request) {
        $category = $request->only(['name']);
        Category::find($request->id)->update($category);
        $message = "カテゴリを更新しました";
        return redirect('/categories')->with(compact('message'));
    }

    public function destroy(Request $request) {
        Category::find($request->id)->delete();
        $message = "カテゴリを削除しました";
        return redirect('/categories')->with(compact('message'));
    }
}
