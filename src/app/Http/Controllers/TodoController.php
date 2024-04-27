<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request) {
        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);
        $message = "Todoを作成しました";
        return redirect('/')->with(compact('message'));
    }

    public function update(TodoRequest $request) {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);
        $message = "Todoを更新しました";
        return redirect('/')->with(compact('message'));
    }

    public function destroy(Request $request) {
        Todo::find($request->id)->delete();
        $message = "Todoを削除しました";
        return redirect('/')->with(compact('message'));
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
