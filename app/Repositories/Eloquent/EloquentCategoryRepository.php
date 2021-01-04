<?php

namespace App\Repositories\Eloquent;

use App\Model\Category;
use App\Repositories\Contracts\CategoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentCategoryRepository extends AbstractRepository implements CategoryRepository
{
    public function entity()
    {
        return Category::class;
    }

    public function getAll() {
		return $this->entity->all();
	}

	public function getById( $id ) {
		return $this->entity->findOrFail( $id );
	}

	public function create( array $attributes ) {
	 if(isset($attributes['category_image'])){
	     $image=$attributes['category_image'];
	    $ext = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/category/');
        $image->move($destinationPath, $ext);
                $attributes['category_image'] = $ext;
                		return $this->entity->create( $attributes );

	 }
	 else{
		return $this->entity->create( $attributes );
	 }
	}

	public function update( $id, array $attributes ) {
		$category = $this->getById( $id );
		$this->delete_category_image($id);
			 if(isset($attributes['category_image'])){
	     $image=$attributes['category_image'];
	    $ext = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/category/');
        $image->move($destinationPath, $ext);
                $attributes['category_image'] = $ext;
                		return $category->update( $attributes );

	 }
	 else{
	   		$category->update( $attributes );  
	 }


		return $category;

	}

	public function delete( $id ) {
		$category = $this->getById( $id );
		// Delete from pivot table as well
		$category->products()->detach( $id );
$this->delete_category_image($id);
		$category->delete();

		return true;
	}
	  public function delete_category_image($id)
    {
        $findData = $this->getById($id);
 if($findData==null){
     return true;
 }
            $fileName = $findData->category_image;
            $deletePath = public_path('images/category/' . $fileName);
            if (file_exists($deletePath) && is_file($deletePath)) {
                unlink($deletePath);
     
        }

        return true;
    }

    public function getCategories() {

		$categories = Category::where( 'parent_id', 0 )->get();

		$categories = $this->addRelation( $categories );
		// $categories = null;
		return $categories;

	}

	public function selectChild( $id ) {
		 $categories = Category::where( 'parent_id', $id )->get(); //rooney

		$categories = $this->addRelation( $categories );
		// $categories = null;
		return $categories;

	}

	public function addRelation( $categories ) {

		$categories->map( function ( $item, $key ) {

			$sub = $this->selectChild( $item->id );

			return $item = array_add( $item, 'subCategory', $sub );

		} );

		return $categories;
	}
}
