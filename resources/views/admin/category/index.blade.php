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
				<div class="card-header"><a href="{{ route('category.create') }}" class="btn btn-outline-success">Create Category</a><span class="float-right">All Category</span></div>

				<div class="card-body">


					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col">Action</th>

							</tr>
						</thead>
						<tbody>
							@if(count($categories)>0)
							@foreach($categories as $key => $category)
							<tr>
								<th scope="row">{{ $category->id }}</th>
								<td>{{ $category->name }}</td>
								<td><a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-warning">Edit</a>
									

									<form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are You Suer Want To Delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
								</td>

							</tr>
							@endforeach
							@else
							<td>No category to display</td>
							@endif
						</tbody>

						<tfoot>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col">Action</th>

							</tr>
						</tfoot>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
