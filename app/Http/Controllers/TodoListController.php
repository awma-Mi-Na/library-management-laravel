<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class TodoListController extends Controller
{
    public function index()
    {
        return TodoList::all('id', 'title')->toJson();
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required'
        ]);
        // if (TodoList::create(request()->all())) {
        // if ($todo = TodoList::create($attributes)) {
        //     return response('success')->json($todo);
        // } else
        //     return response('failed to create task', 500);

        $todo = TodoList::create($attributes);
        if ($todo ?? false) {
            return [
                'title' => $todo->title,
                'id' => $todo->id
            ];
        } else
            return response('failure', 401);
    }

    public function destroy(TodoList $todoList)
    {
        // return response($todoList->toJson());
        if ($todoList->delete())
            return response('success');
        else
            return response('failed to delete', 500);
    }
}
