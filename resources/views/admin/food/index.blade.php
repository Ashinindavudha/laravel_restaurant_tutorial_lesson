@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
			<div class="card">
				<div class="card-header"><a href="{{ route('food.create') }}" class="btn btn-outline-success">Create Food</a> <span class="float-right">All Food</span></div>

				<div class="card-body">


					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Image</th>
								<th scope="col">Name</th>
								<th scope="col">Description</th>
								<th scope="col">Price</th>
								<th scope="col">Category</th>
								<th scope="col">Action</th>

							</tr>
						</thead>
						<tbody>
							@if(count($foods)>0)
							@foreach($foods as $key => $food)
							<tr>
								<th scope="row">{{ $food->id }}</th>
								<td><img src="{{asset('images')}}/{{ $food->image }}" width="100" alt=""></td>
								<td>{{ $food->name }}</td>
								<td>{{ $food->description }}</td>
								<td>${{ $food->price }}</td>
								<td>{{ $food->category->name ?? '' }}</td>
								<td><a href="{{ route('food.edit', $food->id) }}" class="btn btn-outline-warning">Edit</a>
									

									<form action="{{ route('food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Are You Suer Want To Delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
								</td>

							</tr>
							@endforeach
							@else
							<td>No food to display</td>
							@endif
						</tbody>

						<tfoot>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Image</th>
								<th scope="col">Name</th>
								<th scope="col">Description</th>
								<th scope="col">Price</th>
								<th scope="col">Category</th>
								<th scope="col">Action</th>

							</tr>
						</tfoot>

					</table>
					{{ $foods->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
