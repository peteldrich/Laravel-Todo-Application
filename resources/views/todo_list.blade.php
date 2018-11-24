@extends('layout.main')

@section('title', 'List')

@section('content')
<div class="row">
	<div class="container">
		<div class="row">
			@if (!empty(session('message')))
			<div class="col-sm-12">
				<div class="alert {{session('success') ? 'alert-success' : 'alert-danger'}}" role="alert">
					{{session('message')}}
				</div>
			</div>
			@endif
			<div class="col-sm-6">
				<form class="form-inline mb-2" action="{{url('/handleSubmitAddTodo')}}" method="post">
					{{csrf_field()}}
					<div class="form-group">
						<input type="text" class="form-control form-control" id="name" name="name" 
						placeholder="Enter todo" required/>
					</div>
					<button type="submit" class="btn btn-primary ml-2">Add</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-12 mt-4">
		<table class="table" width="100%">
			<thead>
				<tr>
					<th scope="col" width="35%">Todo</th>
					<th scope="col" width="15%">Status</th>
					<th scope="col" width="15%">Created</th>
					<th scope="col" width="15%">Updated</th>
					<th scope="col" width="20%"></th>
				</tr>
			</thead>
			@if (!$todoList->isEmpty())
			<tbody>
				@foreach ($todoList as $todo)
				<tr>
					<td>{{$todo->name}}</td>
					<td>{{$todo->status}}</td>
					<td>{{$todo->created_at}}</td>
					<td>{{$todo->updated_at}}</td>
					<td class="text-center">
						<a href="{{url('/edit/' . $todo->id)}}" class="btn btn-info">Edit</a>
						<a href="{{url('/handleSubmitDeleteTodo/' . $todo->id)}}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
			@endif
		</table>
		@if ($todoList->isEmpty())
		<div class="col-sm-12">
			<div class="text-center">No data to display.</div>
		</div>
		@endif
	</div>
</div>
@endsection