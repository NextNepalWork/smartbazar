<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Image\ImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Mail\ProductAlert;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\ProductAdditional;
use App\Model\ProductFaq;
use App\Model\ProductFeature;
use App\Model\ProductImage;
use App\Model\ProductRelation;
use App\Model\ProductSpecifaction;
use App\Model\VendorDetail;
use App\Repositories\Contracts\ProductRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mail;
use Slim\Slim;


class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
       
        $this->productRepository = $productRepository;
    }

    public function getProductCreate()
    {
        $products = Product::where('main', 1)->where('status','!=','deleted')->get();

        return view('merchant.product.existing', compact('products'));
    }

    public function create()
    {
        $brands = Brand::where('status', 1)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $warranty_types = getWarranty();

        return view('merchant.product.newproduct', compact('brands', 'categorys','warranty_types'));
    }

    public function createExistingProduct(Request $request)
    {
        $request->validate(['product' => 'required']);

        $brands = Brand::where('status', 1)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $existing = Product::where('id', $request->product)->first();

        return view('merchant.product.create', compact('brands', 'categorys', 'existing'));
    }


    public function store(ProductRequest $request)    {
        

     
        // try{
            if(isset($request->existing))
            {
                $request['main'] = 0;
            }
            else
            {
                $request['main'] = 1;
            }
           
            $product = $this->productRepository->store($request->all());
           
            ProductRelation::create([
                'product_id' => $request->existing ? $request->existing : $product->id,
                'relation_id' => $product->id
            ]);

            $user= Auth::user();
            $shop_name= VendorDetail::where('user_id',$user->id);

            $emailData = [
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'name'=>$request->name,
                'price'=>$request->sale_price,
                'phone'=>$user->phone,
                'shop_name'=>$shop_name
            ];

            //\Mail::to(getConfiguration('site_primary_email') != null ? getConfiguration('site_primary_email') : env('MAIL_USERNAME'))->send(new ProductAlert($emailData));

            $sendData = array
            (
                'body'  => 'New Product All Dokan Hurry Up',
                'title' => 'New Product in All Dokan',
                'icon'  => 'myicon',/*Default Icon*/
                'sound' => 'mySound',/*Default sound*/
                'image' => $product->getImageAttribute()->mediumUrl,
                'id' => $product->id,
            );
            $response = onesignalNotification($sendData);

            
            if(isset($request->existing))
            {
                return redirect()->route('vendor.products.create')->with('success', 'Product Successfully Added.');
            }


        // } catch ( Exception $e ) {

        //     throw new Exception( 'Error in saving product: ' . $e->getMessage() );
        // }
        return redirect()->back()->with('success', 'Product Successfully Added.');

    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 'deleted'
        ]);
        $this->productRepository->deleteProduct($id);
        // $product->status= 'deleted';
        $product->save();

        return redirect()->back()->with('success', 'Product Successfully Deleted.');
    }

    public function getProductsJson(Request $request)
    {
        $user=User::findorfail(auth()->id());

        switch ( $request->status ) {
            case 'approved':
                $products = $user->products()->where('approved', 1)->whereNotIn('status',['deleted'])->get();
                break;
            case 'pending':
                $products = $user->products()->where('approved', 0)->whereNotIn('status',['deleted'])->get();
                break;
            case 'published':
                $products = $user->products()->where('status', 'published')->get();
                break;
            case 'unpublished':
                $products = $user->products()->where('status', 'unpublished')->get();
                break;
            case 'deleted':
                $products = $user->products()->where('status', 'deleted')->get();
                break;
            case 'all':
                $products = $user->products()->whereNotIn('status',['deleted'])->get();
                break;
        }

        return datatables($products)->toJson();
    }

    public function getProductsJson2()
    {
        $user=User::findorfail(3);
        $products = $user->products();

        return datatables($products)->toJson();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::where('status', 1)->get();
        $categorys = Category::where('parent_id',0)->get();
        $warranty_types = getWarranty();
        return view('merchant.product.edit', compact('product', 'brands', 'categorys','warranty_types'));
    }

    public function update(Request $request)
    {
        try{
            $this->productRepository->updateProducts($request->id, $request->all());
        } catch ( Exception $e ) {

            throw new Exception( 'Error in updating product: ' . $e->getMessage() );
        }
        return redirect()->route('vendor.products.table', 'status=all')->with('success', 'Product Successfully Updated.');
    }

    public function table()
    {
        $all = Product::where('user_id', auth()->id())->whereNotIn('status',['deleted'])->count();
        $pending=Product::where('approved',0)->where('user_id', auth()->id())->whereNotIn('status',['deleted'])->count();
        $approved=Product::where('approved',1)->where('user_id', auth()->id())->whereNotIn('status',['deleted'])->count();
        $published=Product::where('status','published')->where('user_id', auth()->id())->count();
        $unpublished=Product::where('status','unpublished')->where('user_id', auth()->id())->count();
        $deleted=Product::where('status','deleted')->where('user_id', auth()->id())->count();

        return view('merchant.product.index', compact('all', 'pending', 'approved','published','unpublished','deleted'));
    }

    public function uploadImage( Request $request ) {
        $image          = $request->file( 'image' );
        $tmpPath        = str_split( strtolower( str_random( 3 ) ) );
        $checkDirectory = '/uploads/product/images/' . implode( '/', $tmpPath );

        $dbPath = $checkDirectory . '/' . $image->getClientOriginalName();

        $imageService = new ImageService();
        $image        = $imageService->upload( $image, $checkDirectory );

        $tmp = $this->_getTmpString();
        return view( 'merchant.product.upload-image' )
            ->with( 'image', $image )
            ->with( 'tmp', $tmp );
    }

    public function _getTmpString( $length = 6 ) {
        $pool = 'abcdefghijklmnopqrstuvwxyz';

        return substr( str_shuffle( str_repeat( $pool, $length ) ), 0, $length );
    }
    public function deleteImage( Request $request ) {
        $collection = ProductImage::where( 'path', $request->input( 'path' ) )->get(['id']);
//        foreach ($collection as $sizeName => $image) {
//            $baseName = basename($image->relativePath);
//            $sizeNamePath = str_replace( $baseName, $sizeName . "-" . $baseName, $image->relativePath );
//                File::delete(public_path($sizeNamePath));
//        }
//        dd($collection);
        ProductImage::destroy( $collection->toArray() );

        return response()->json( [
            'success' => true,
            'message' => 'Image successfully deleted.',
        ] );
    }


    public function all(){
        return $this->model->all();
    }

    public function stock()
    {
        $user=auth()->id();
        $products = Product::where('user_id', $user)->paginate(10);
        return view('merchant.product.stock_manager', compact('products'));
    }

    public function deleteFaq( Request $request ) {
        $faq = ProductFaq::findOrFail( $request->input( 'faq' ) );

        $faq->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Faq successfully deleted!!'
        ] );
    }

    public function deleteSpecification( Request $request ) {
        $specification = ProductSpecifaction::findOrFail( $request->input( 'specification' ) );

        $specification->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Specification successfully deleted!!'
        ] );
    }

    public function deleteFeature( Request $request ) {
        $feature = ProductFeature::findOrFail( $request->input( 'feature' ) );

        $feature->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Feature successfully deleted!!'
        ] );
    }

    public function deleteColor( Request $request ) {
        $color = ProductAdditional::findOrFail( $request->input( 'color' ) );

        $color->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Color successfully deleted!!'
        ] );
    }

}



