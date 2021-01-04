<!-- Modal -->

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Edit Service Category</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.service.category.update') }}" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="{{$serviceCategory->id}}">
        {{csrf_field()}}
      <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{$serviceCategory->name}}">
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control" value="" id="image">
        @if($serviceCategory->getImage())
        <img src="{{$serviceCategory->getImage()->smallUrl}}" alt="Image" style="width:50%;height:auto;">
        @endif
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="5">{{$serviceCategory->description}}</textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
