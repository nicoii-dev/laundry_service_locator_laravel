<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Shop;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $validation = $request->validate([
            'service_name' => 'sometimes|nullable',
            'price' => 'sometimes|nullable',
        ]);
        if($request->has('price') && $request->has('service_name') ) {
            $query = Service::with('shop')
            ->where('service_name', $request['service_name'])
            ->whereBetween('price', [json_decode($request['price'])->minPrice, json_decode($request['price'])->maxPrice])
            ->get();
            return response()->json(['services' => $query], 200);
        } else if($request->has('service_name')){
            $service = Service::with('shop')
            ->where('service_name', $request['service_name'])
            ->get();
            return response()->json(['services' => $service], 200);
        } else {
            $query = Service::with('shop')
            ->whereBetween('price', [json_decode($request['price'])->minPrice, json_decode($request['price'])->maxPrice])
            ->get();
            return response()->json(['services' => $query], 200);
        }

    }
    
    public function index()
    {
        $query = Service::with('shop')->get();
        return response()->json(['services' => $query], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLabandero(Request $request)
    {
        $query = User::with('profile')->get();
        return response()->json(['labandero' => $query], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
