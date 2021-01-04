
    <form id="categoryForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Category Description:</label>
            <textarea name="description" rows="5" placeholder="About this category" class="form-control"></textarea>
        </div>
             <div class="form-group">
            <label for="description">Category Image</label>
       <input type="file" name="category_image">
        </div>
        <div class="form-group">
            <label for="parent_id">Select Parent Catgory:</label>
            <select name="parent_id" id="theSelect" class="form-control">
                <option value="0">Select Main Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @include('admin.category.dropdown')
                @endforeach
            </select>
        </div>
        <button type="submit" name="" class="category-add">Add</button>
    </form>
