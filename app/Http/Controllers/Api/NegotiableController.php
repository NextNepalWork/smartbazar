<?php

namespace App\Http\Controllers\Api;

use App\Model\Negotaible;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\NegotiablePrice;
use Carbon\Carbon;
use App\Http\Resources\NegotiableUser;

class NegotiableController extends Controller
{
    public function add_negotiable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 406);
        }
        $product_id = $request->product_id;
        $nego_product = Negotaible::where('product_id', $product_id)->where('user_id', auth('api')->id())->first();
        if ($nego_product) {
            return response()->json([
                'status' => 'success',
                'message' => 'Negotiable Already Added',
                'negotiable_id' => $nego_product->id,

            ]);

        }
        $new = new Negotaible();
        $new->product_id = $product_id;
        $new->user_id = auth('api')->id();
        if ($new->save()) {

            return response()->json([
                'status' => 'success',
                'message' => 'Negotiable Added',
                'negotiable_id' => $new->id,
            ], 200);
        }
        return true;
    }

    public function view_negotiable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'negotiable_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 406);
        }
        $negotiable = Negotaible::where('id', $request->negotiable_id)->first();
        $last = NegotiablePrice::where('negotiable_id', $negotiable->id)->where('user_id', auth()->id())->orderBy('id', 'DESC')->first();
        if (!empty($last)) {
            $last_date = Carbon::parse($last->updated_at);
            $result = $last_date->diffInDays(Carbon::now(), false);
        }
        $negotiable->product_id = globalproducts($negotiable->product_id);
        $negotiable->products = $negotiable->product_id;
        unset($negotiable->product_id);

       
        $message=$negotiable->negotiableMessages;

        return response()->json([
            'negotiable' => $negotiable,
            // 'result' => isset($result) ? $result : null,
        ], 200);


    }

    public function all_negotiable(Request $request)
    {

        $negotiables = Negotaible::where('user_id', Auth::user()->id)->get();

        $nego = NegotiableUser::collection($negotiables);
        return response()->json([
            'negotiables' => $nego
        ], 200);
    }

    public function send_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'negotiable_id' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 406);
        }

        $negotiable = Negotaible::findorfail($request->negotiable_id);

        $negotiable1 = NegotiablePrice::where('negotiable_id', $negotiable->id)->get();
        foreach ($negotiable1 as $row) {
            $row->active = 0;
            $row->update();
        }
        $message = $request->message;

        $negotiable->negotiableMessages()->create([
            'negotiable_id' => $negotiable->id,
            'message' => $message,
            'user_id' => auth()->id(),
            'active' => 1
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Message Sucessfully Sent'
        ], 200);


    }
      public function delete_negotiable(Request $request)
    {
        $negotiable = Negotaible::find($request->negotiable_id);
        if ($negotiable->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Negotiable has been Deleted'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error in Deleting Negotiable'
        ], 417);
    }
}
