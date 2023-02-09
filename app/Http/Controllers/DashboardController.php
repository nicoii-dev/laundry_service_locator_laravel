<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        $users = User::all();
        $services = Service::all();
        $deactivatedUser = User::where('status', 0)->get();

        // getting total number of users each month
        for($i=1; $i <= 12; $i++){
            $overall_total = 0;
                foreach($users as $result) {
                    if(date("m", strtotime($result->created_at)) == $i){
                        $overall_total = $overall_total + 1;
                    }	
                }	             
                $month_report[] = $overall_total;
            }
        return response()->json([
            'shops' => $shops,
            'users' => $users,
            'services' => $services,
            'deactivatedUser' => $deactivatedUser,
            'usersGraph' => $month_report
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
