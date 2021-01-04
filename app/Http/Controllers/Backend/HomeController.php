<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Deal;
use App\Model\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function getHome()
	{
		$categories = [
			              'Latest' => 'Latest',
		              ] + Deal::pluck('name', 'name')->toArray() + Category::pluck( 'name', 'name' )->toArray();
		              
		$selectedCategories_1 = getHome( 'products_section_1' );
		$selectedCategories_2 = getHome( 'products_section_2' );
		$selectedCategories_3 = getHome( 'products_section_3' );
		$selectedCategories_4 = getHome( 'products_section_4' );
		$selectedCategories_5 = getHome( 'products_section_5' );
		$selectedCategories_6 = getHome( 'products_section_6' );
		$selectedCategories_7 = getHome( 'products_section_7' );
		$selectedCategories_8 = getHome( 'products_section_8' );
		$deals_date = getHome( 'deals_date' );

		return view('admin.home.index')->with( [
			'categories'           => $categories,
			'selectedCategories_1' => $selectedCategories_1,
			'selectedCategories_2' => $selectedCategories_2,
			'selectedCategories_3' => $selectedCategories_3,
			'selectedCategories_4' => $selectedCategories_4,
			'selectedCategories_5' => $selectedCategories_5,
			'selectedCategories_6' => $selectedCategories_6,
			'selectedCategories_7' => $selectedCategories_7,
			'selectedCategories_8' => $selectedCategories_8,
			'deals_date' => $deals_date,
		] );
	}

    public function postHome(Request $request)
    {
    	$inputs = $request->only(
    		'products_section_1',
    		'products_section_2',
    		'products_section_3',
    		'products_section_4',
    		'products_section_5',
    		'products_section_6',
    		'products_section_7',
    		'products_section_8',
			'deals_date'
    	);

    	foreach ( $inputs as $inputKey => $inputValue ) {
			Home::updateOrCreate( [ 'home_key' => $inputKey ], [ 'home_value' => $inputValue ] );
		}

		return redirect()->back()->with( 'success', 'Home Settings successfully updated!!' );
    }
}
