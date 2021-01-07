<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Image\LocalImageFile;
use App\Model\Media;
use App\Model\ServiceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.service.service_category.index');
    }


    public function getServiceCategoryJson()
    {
        $service_categories = ServiceCategory::all();
        foreach ($service_categories as $service_category) {
            $image = null !== $service_category->getImage()? $service_category->getImage()->smallUrl: $service_category->getDefaultImage()->smallUrl;
            $service_category->image = $image;
        }


        return datatables( $service_categories )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);

            $service_category = ServiceCategory::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);


            if($service_category){
                if ( isset( $request['image'] ) ) {
                    try {
                        $media = new Media();
                        $media->upload( $service_category, $request['image'], '/uploads/service/' );
                    } catch (Exception $e) {

                        return $e;
                    }
                }

                return redirect()->back()
                    ->with('success' , 'Service Category created successfully');
            }

        return back()->withInput()->with('errors', 'Error creating new Service Category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$serviceCategory = ServiceCategory::find($id);
        return view('admin.service.service_category.edit',compact('serviceCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $serviceCategory = ServiceCategory::find($request->id);
        $service_category = ServiceCategory::where('id', $request->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);



        if($service_category){
            if ( isset( $request['image'] ) ) {
                // Delete image
                $path = optional($serviceCategory->media()->first())->path;
                $this->deleteImage( $path );

                // Clean image database links
                $serviceCategory->media()->delete();

                // Upload new image
                $media = new Media();
                $media->upload( $serviceCategory, $request['image'], '/uploads/service/' );
            }

            return redirect()->back()
                ->with('success' , 'Service Category Updated successfully');
        }

        return back()->withInput()->with('errors', 'Error Updating Service Category');






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceCategory = ServiceCategory::find($id);
//        dd($serviceCategory);
        // Delete image
        $path = optional($serviceCategory->media()->first())->path;
        $this->deleteImage( $path );

        // Clean image database links
        $serviceCategory->media()->delete();

        $serviceCategory->delete();

        return response()->json('Service Category Sucessfullly Deleted');

    }

    public function deleteImage( $path ) {
        if ( null === $path ) {
            return false;
        }

        $localImageFile = new LocalImageFile( $path );
        $localImageFile->destroy();

        return true;
    }
}
