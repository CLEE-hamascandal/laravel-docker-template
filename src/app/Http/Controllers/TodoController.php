<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todoList = $todo->all();

        return view('todo.index', ['todos' => $todoList]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);

        $todo = new Todo();
        $todo->fill($inputs);
        $todo->save();
        // INSERT INTO todos (content) VALUES ('$todo[content]')

        return redirect()->route('todo.index');
    }
}
