<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Todo as TodoModel;


class TemplateController extends BaseController
{
    public function __construct()
    {
    }

    public function todoList()
    {
    	$todoList = TodoModel::all();

    	return view('todo_list', ['todoList' => $todoList]);
    }

    public function todoEdit(Request $request, $id)
    {
    	$todo = TodoModel::find($id);

    	return view('todo_edit', ['todo' => $todo]);
    }
}
