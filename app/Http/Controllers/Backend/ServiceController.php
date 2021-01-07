<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Image\LocalImageFile;
use App\Model\Media;
use App\Model\Service;
use App\Model\ServiceCategory;
use App\Model\ServiceLocation;
use App\Model\ServiceTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.service.services.index');
    }


    public function getServiceJson()
    {



        $services = Service::all();
//        $serviceCategory = ServiceCategory::where('id', 1)->get();
        foreach ($services as $service) {
            $image = null !== $service->getImage()? $service->getImage()->smallUrl: $service->getDefaultImage()->smallUrl;
            $service->image = $image;
        }
        foreach ($services as $service){

            $serviceCategory = ServiceCategory::where('id', $service->parent_id)->pluck('name');

            $service->category = $serviceCategory;
        }
//        dd($services);
        return datatables( $services )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceCategory = ServiceCategory::all();
        return view('admin.service.services.form', compact('serviceCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $service = Service::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);


        if($service){
            if ( isset( $request['image'] ) ) {
                try {
                    $media = new Media();
                    $media->upload( $service, $request['image'], '/uploads/service/' );
                } catch (Exception $e) {

                    return $e;
                }
            }



            if ( isset( $request['locations'] ) ) {
                $location_titles = $request['locations']['location'];

                $locationsKeys = array_keys($location_titles);

                // Create specification
                foreach ($locationsKeys as $location) {
                    $service->locations()->create([
                        'service_id' => $service->id,
                        'location' => $location_titles[$location],
                    ]);
                }
            }

            if ( isset( $request['times'] ) ) {
                $time_titles = $request['times']['time'];

                $timesKeys = array_keys($time_titles);

                // Create specification
                foreach ($timesKeys as $time) {
                    $service->times()->create([
                        'service_id' => $service->id,
                        'time' => $time_titles[$time],
                    ]);
                }
            }







            return redirect()->back()
                ->with('success' , 'Service created successfully');
        }

        return back()->withInput()->with('errors', 'Error creating new Service');
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
        $service = Service::find($id);
        $serviceCategory = ServiceCategory::all();
//        dd($service->locations->n);
        return view('admin.service.services.edit',compact('service','serviceCategory'));
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
//        dd($request);
        $services = Service::find($request->id);
        $service = Service::where('id', $request->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);



        if($service){
            if ( isset( $request['image'] ) ) {
                // Delete image
                $path = optional($services->media()->first())->path;
                $this->deleteImage( $path );

                // Clean image database links
                $services->media()->delete();

                // Upload new image
                $media = new Media();
                $media->upload( $services, $request['image'], '/uploads/service/' );
            }

            if ( isset( $request['locations'] ) ) {
                $location_titles = $request['locations']['location'];

                $locationsKeys = array_keys($location_titles);

                // Create specification
                foreach ($locationsKeys as $location) {
                    $services->locations()->updateOrCreate([
                        'id' => $location],[
                        'service_id' => $services->id,
                        'location' => $location_titles[$location],
                    ]);
                }
            }

            if ( isset( $request['times'] ) ) {
                $time_titles = $request['times']['time'];

                $timesKeys = array_keys($time_titles);

                // Create specification
                foreach ($timesKeys as $time) {
                    $services->times()->updateOrCreate([
                        'id' => $time],[
                        'service_id' => $services->id,
                        'time' => $time_titles[$time],
                    ]);
                }
            }





            return redirect()->back()
                ->with('success' , 'Service  Updated successfully');
        }

        return back()->withInput()->with('errors', 'Error Updating Service');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $services = Service::find($id);
//        dd($serviceCategory);
        // Delete image
        $path = optional($services->media()->first())->path;
        $this->deleteImage( $path );

        // Clean image database links
        $services->media()->delete();

        $services->delete();

        return response()->json('Service Sucessfullly Deleted');


    }

    public function deleteLocation( Request $request ) {
        $location = ServiceLocation::findOrFail( $request->input( 'location' ) );

        $location->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Location successfully deleted!!'
        ] );
    }

    public function deleteTime( Request $request ) {
        $time = ServiceTime::findOrFail( $request->input( 'time' ) );

        $time->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Time successfully deleted!!'
        ] );
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
