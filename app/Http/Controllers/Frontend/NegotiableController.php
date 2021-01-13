<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Negotaible;
use App\Model\NegotiablePrice;
use App\Model\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NegotiableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $negotiable = Negotaible::where('id', $id)->first();
        $last = NegotiablePrice::where('negotiable_id', $negotiable->id)->where('user_id', auth()->id())->orderBy('id', 'DESC')->first();

        if (!empty($last)) {
            $last_date = Carbon::parse($last->updated_at);
            $result = $last_date->diffInDays(Carbon::now(), false);
        }
        $result = null;

        return view('front.my_account.negotiate', compact('negotiable', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //        $validator = Validator::make($request->all(), [
        //            'bargain_price' => 'required|numeric'
        //        ])->validate();

        $product_id = $request->product_id;
        $nego_product = Negotaible::where('product_id', $product_id)->where('user_id', auth()->id())->first();
        if ($nego_product) {
            return redirect()->route('negotiate.chat', $nego_product->id)->with('success', 'Negotiable has already been added before');
        }
        $new = new Negotaible();
        $new->product_id = $product_id;
        $new->user_id = auth()->id();
        $new->fixed_price = $request->fixed_price;
        if ($new->save()) {

            return redirect()->route('negotiate.chat', $new->id)->with('success', 'Negotiable has been Added');
        }
        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {

        $negotiable = Negotaible::findorfail($id);

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

        //        $negotiable1 = DisputeMessage::where('dispute_id',$dispute->id)->get();


        return redirect()->back()->with('success', 'Message Sucessfully Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    public function reload(Request $request)
    {
        dd('reload');


        $negotiate_product = NegotiablePrice::where('negotiable_id', $request->id)->where('active', 1)->first();
        //        foreach($dispute as $row) {
        //            $row->active = 0;
        //            $row->save();
        //        }
        dd($negotiate_product);
        return view('front.my_account.reload', compact('negotiate_product'));
        //        if(Auth::user()->hasRole(['admin','vendor']))
        //        {
        //            return view('admin.disputes.reload', compact('dispute'));
        //        }
        //        else
        //        {
        //            return view('front.disputes.reload', compact('dispute'));
        //        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negotiable = Negotaible::find($id);
        if ($negotiable->delete()) {
            return redirect()->back()->with('success', 'Negotiable has been Deleted');
        }

        return redirect()->back()->with('error', 'Error while Deleting');
    }
    public function checkout($id)
    {
        $neg = Negotaible::findorfail($id);
        $product_id = $neg->product_id;
        $product_name = Product::findorfail($product_id)->name;
        if ($neg->user_id == auth()->id() && $neg->fixed_price) {
            Cart::add([
                'id' => $product_id,
                'name' => $product_name,
                'qty' => 1,
                'price' => $neg->fixed_price,


            ]);
            //            dd(Cart::content());
            return redirect()->route('checkout');
        } else {
            return redirect()->back();
        }
    }
}
