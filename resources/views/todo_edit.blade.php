@extends('layout.main')

@section('title', 'Edit')

@section('content')
<div class="row">
	<div class="col-sm-4 m-auto mt-4">
		@if (!empty(session('message')))
		<div class="alert {{session('success') ? 'alert-success' : 'alert-danger'}}" role="alert">
			{{session('message')}}
		</div>
		@endif
		<form action="{{url('/handleSubmitUpdateTodo')}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<input type="hidden" name="id" value="{{$todo->id}}"/>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" 
				placeholder="Enter todo" value="{{$todo->name}}" required/>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select class="form-control" name="status" id="status">
					@foreach (['Pending', 'Done', 'On Hold'] as $status)
					@if ($todo->status === $status)
					<option selected>{{$status}}</option>
					@else
					<option>{{$status}}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection