
	<div class="col-md-4">
		<form action="{{ route('admin.service.category.store')  }}" enctype="multipart/form-data" id="serviceCategory" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" placeholder="Enter Name" required>
			</div>

			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image" class="form-control">
			</div>
			<input type="checkbox" name="box[]" value="test">
			<input type="checkbox" name="box[]" value="abc">
			<input type="checkbox" name="box[]" value="xyz">
			<div class="form-group">
				<label for="description">Service Description</label>
				<textarea name="description" class="form-control" placeholder="Enter Description" value="" rows="5"></textarea>
			</div>

			<button type="submit" name="submit" class="btn-add" >Add Service Category</button>
		</form>
	</div>