<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $request->validate([
            // 'house_number' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            // 'city' => 'required',
            // 'province' => 'required',
            'formatted_address' => 'required',
            'zipcode' => 'required',
            'location' => 'required',
        ]);

        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if($profile !== null) {
            return response()->json(['message' => 'Already have a profile', 'data' => $profile], 200);
        };

        $createdProfile = Profile::create([
            'user_id' => Auth::user()->id,
            'house_number' => $request['house_number'],
            'street' => $request['street'],
            'barangay' => $request['barangay'],
            // 'city' => $request['city'],
            // 'province' => $request['province'],
            'formatted_address' => $request['formatted_address'],
            'zipcode' => $request['zipcode'],
            'location' => $request['location'],
        ]);

        $profile = Profile::find($createdProfile->id);
        return response()->json($profile, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        return response()->json($profile, 200);
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
        $request->validate([
            // 'house_number' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            // 'city' => 'required',
            // 'province' => 'required',
            'formatted_address' => 'required',
            'zipcode' => 'required',
            'location' => 'required',
        ]);

        Profile::where('user_id', Auth::user()->id)->update([
            'house_number' => $request['house_number'],
            'street' => $request['street'],
            'barangay' => $request['barangay'],
            // 'city' => $request['city'],
            // 'province' => $request['province'],
            'formatted_address' => $request['formatted_address'],
            'zipcode' => $request['zipcode'],
            'location' => $request['location'],
        ]);
        
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        return response()->json($profile, 200);
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
