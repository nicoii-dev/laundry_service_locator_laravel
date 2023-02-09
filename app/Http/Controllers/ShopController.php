<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Service;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Service::with('shop')->get();
    }

    public function userShops($id)
    {
        return DB::table('shops')
        ->where('shops.user_id', $id)
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'shop_name' => 'required|unique:shops,shop_name',
            'street' => 'required',
            'barangay' => 'required',
            'formatted_address' => 'required',
            'zipcode' => 'required',
            'location' => 'required',
        ]);

        if($validation){
            $shop = new Shop();
            $shop->user_id = Auth::user()->id;
            $shop->shop_name = $request->shop_name;
            $shop->building_number = $request->building_number;
            $shop->street = $request->street;
            $shop->barangay = $request->barangay;
            $shop->formatted_address = $request->formatted_address;
            // $shop->city = $request->city;
            // $shop->province = $request->province;
            $shop->zipcode = $request->zipcode;
            $shop->location = $request->location;
            $shop->save();
            return response()->json([
                'message' => "Shop successfully created."
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        return response()->json($shop, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'shop_name' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'formatted_address' => 'required',
            // 'city' => 'required',
            // 'province' => 'required',
            'zipcode' => 'required',
            'location' => 'required',
        ]);

        $shop = Shop::where('shop_name', $request['shop_name'])
            ->where('id', '!=', $id)
            ->first();
        if($shop !== null) {
            return response()->json('Shop name is already taken', 422);
        };

        Shop::where('id', $id)->update([
            'shop_name' => $request['shop_name'],
            'building_number' => $request['building_number'],
            'street' => $request['street'],
            'barangay' => $request['barangay'],
            'formatted_address' => $request['formatted_address'],
            // 'city' => $request['city'],
            // 'province' => $request['province'],
            'zipcode' => $request['zipcode'],
            'location' => $request['location'],
        ]);

        $shop = Shop::find($id);
        return response()->json(['message' => 'Shop successfully updated.', 'data' => $shop], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table("shops")->where('id',$id)->delete()){
            $shops = DB::table('shops')->get();
            return response()->json(['message' => 'Shop successfully deleted.', 'data' => $shops], 200);
        }else{
            return response()->json(['message' => 'Delete unsuccessful'], 500);
        }
    }
}
