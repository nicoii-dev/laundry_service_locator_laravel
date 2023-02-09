<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Service::all();
    }

    public function shopServices($id)
    {
        return DB::table('services')
        ->where('services.shop_id', $id)
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
       $request->validate([
            'shop_id' => 'required',
            'service_name' => 'required',
            'price' => 'required',
        ]);
        $service = Service::where([
            ['service_name', $request['service_name']],
            ['shop_id', $request['shop_id']],
        ])
        ->first();

        if($service !== null) {
            return response()->json([
                'message' => "Service name is already taken."
            ], 422);
            // return response()->json('Service name is already taken', 422);
        };

        Service::create([
            'shop_id' => $request['shop_id'],
            'service_name' => $request['service_name'],
            'price' => $request['price'],
        ]);

        $services = DB::table('services')->get();
        return response()->json($services, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return response()->json($service, 200);
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
        $request->validate([
            'shop_id' => 'required',
            'service_name' => 'required',
            'price' => 'required',
        ]);
        $service = Service::where([
            ['service_name', $request['service_name']],
            ['shop_id', $request['shop_id']],
        ])
        ->where('id', '!=', $id)
        ->first();

        if($service !== null) {
            return response()->json('Service name is already taken', 422);
        };

        Service::where('id', $id)->update([
            'service_name' => $request['service_name'],
            'price' => $request['price'],
        ]);

        $service = Service::find($id);
        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table("services")->where('id',$id)->delete()){
            $services = DB::table('services')->get();
            return response()->json(['message' => 'Shop successfully deleted.', 'data' => $services], 200);
        }else{
            return response()->json(['message' => 'Delete unsuccessful'], 500);
        }
    }
}
