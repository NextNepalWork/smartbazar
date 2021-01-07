<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-center" id="exampleModalLabel">Edit Category</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form id="catgoryUpdate">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $category_get->id }}">

				<div class="form-group">
					<label for="name">Category Name:</label><br><br>
					<input type="text" name="name" class="form-control" value="{{ $category_get->name }}">
				</div>
				<div class="form-group">
					<label for="description">Category Description:</label>
					<textarea name="description" rows="7" placeholder="About this category" class="form-control">{{$category_get->description}}</textarea>
				</div>
				<div class="form-group">
					<label for="description">Current Image</label>
					<img src="{{asset('images/category/'.$category_get->category_image)}}" style="height:150px widht:150px">
				</div>
				<div class="form-group">
					<label for="description">Category Image</label>
					<input type="file" name="category_image">
				</div>
				<div class="form-group">
					<label for="parent_id">Select Parent Category:</label>
					<select name="parent_id" class="form-control">
						<option value="0">Select Parent Category</option>

						@foreach($categories as $category)
							<option @if($category->id == $category_get->parent_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
							@include('admin.category.dropdown',['category_get'=>$category_get])
						@endforeach
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary category-update">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
