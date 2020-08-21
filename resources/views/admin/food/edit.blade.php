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
				<div class="card-header">Update Food</div>

				<div class="card-body">
					<form method="POST" action="{{ route('food.update', [$food->id]) }}" enctype="multipart/form-data">
						@method('PUT')
						@csrf
						<div class="form-group">
							<label for="name">Food Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $food->name }}">
							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>


						<div class="form-group">
							<label for="description">Food Description</label>
							<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $food->description }}</textarea>
							@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="price">Food Price</label>
							<input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $food->price }}">
							@error('price')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="category">Food Category</label>
							<select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
								@error('category')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
								<option value="">Select Category</option>
								@foreach(App\Category::all() as $category)
								<option value="{{ $category->id }}" 
									@if($category->id==$food->category_id) selected 
									@endif>
									{{ $category->name }}
								</option>
								@endforeach
							</select>

                {{-- <select name="category" class="form-control" id="category">
                    	@foreach(App\Category::all() as $category)
                    	<option value="{{ $category->id }}">
                    		{{ $category->name }}
                    	</option>
                    	@endforeach
                    </select> --}}

                </div>
                <div class="form-group">
                	<label for="image">Food Image</label>
                	<input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ $food->image }}">
                	@error('image')
                	<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
                	</span>
                	@enderror
                </div>
                <div class="form-group">
                	<button class="btn btn-danger" type="submit">
                		Update
                	</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
	CKEDITOR.replace( 'description' );
</script>
@stop
