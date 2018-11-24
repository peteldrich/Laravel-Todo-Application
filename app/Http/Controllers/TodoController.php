<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Todo as TodoModel;


class TodoController extends BaseController
{
    public function __construct()
    {
    }

    public function add(Request $request)
    {
    	$request->session()->flash('success', FALSE);
    	$todoName = $request->input('name');

    	$todo = new TodoModel;
    	$todo->name = $todoName;
    	$todo->status = 'Pending';

    	$todoDbRecord = TodoModel::where('name', $todoName)->first();

    	if (!empty($todoDbRecord)) {
    		$request->session()->flash('message', trans('app.todoNameExists'));
    		return redirect('/');
    	}

    	$isSaved = $todo->save();

    	if ($isSaved) {
    		$request->session()->flash('success', TRUE);
    		$request->session()->flash('message', trans('app.todoAddSuccess'));
    	} else {
    		$request->session()->flash('message', trans('app.todoAddFailed'));
    	}

    	return redirect('/');
    }

    public function update(Request $request)
    {
    	$request->session()->flash('success', FALSE);
    	$todoId = $request->input('id');
    	$todoName = $request->input('name');
    	$todoStatus = $request->input('status');

    	$redirectUri = '/edit/' . $todoId;
    	$currentTodoDetails = TodoModel::find($todoId);

    	if ($currentTodoDetails->name !== $todoName) {
    		$newTodoDetails = TodoModel::where('name', $todoName)->first();
    		if (!empty($newTodoDetails)) {
				$request->session()->flash('message', trans('app.todoNameExists'));
				return redirect($redirectUri);
    		}
    	}

    	$currentTodoDetails->name = $todoName;
    	$currentTodoDetails->status = $todoStatus;

    	$isSaved = $currentTodoDetails->save();

    	if ($isSaved) {
    		$request->session()->flash('success', TRUE);
    		$request->session()->flash('message', trans('app.todoUpdateSuccess'));
    	} else {
    		$request->session()->flash('message', trans('app.todoUpdateFailed'));
    	}

    	return redirect($redirectUri);
    }

    public function delete(Request $request, $id)
    {
    	$request->session()->flash('success', FALSE);
    	$isDeleted = TodoModel::destroy($id);

    	if ($isDeleted) {
			$request->session()->flash('success', TRUE);
    		$request->session()->flash('message', trans('app.todoDeleteSuccess'));
    	} else {
    		$request->session()->flash('message', trans('app.todoDeleteFailed'));
    	}

    	return redirect('/');
    }
}
