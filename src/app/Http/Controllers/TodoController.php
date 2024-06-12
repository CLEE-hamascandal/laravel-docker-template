<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $todoList = $this->todo->all();

        return view('todo.index', ['todos' => $todoList]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);

        $this->todo->fill($inputs);
        $this->todo->save();
        // INSERT INTO todos (content) VALUES ('$todo[content]')

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        
        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        //formからの情報を取得する
        $inputs = $request->all();

        //DB内のデータを取得する
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }
}
