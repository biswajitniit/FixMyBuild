<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Useraddresses;
use Illuminate\Support\Facades\Crypt;
class MyaddressController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        $useraddress = Useraddresses::where('user_id',Auth::user()->id)->get();
        return view('dashboardarea.my-addresses',compact('useraddress'));
    }


	public function add_new_addresses(){
        return view('dashboardarea.add-my-addresses');
    }

    public function add_addresses_save(Request $request){
        $this->validate($request, [
            'name'                    => 'required',
            'mobileno'                => 'required',
            'pincode'                 => 'required',

        ],[
            'address_type.name' => 'Please enter name',
            'mobileno.required' => 'Please enter mobile no',
            'pincode.required' => 'Please enter pincode',
        ]);

    	$useraddresses = new Useraddresses();
            $useraddresses->user_id                  = Auth::user()->id;
            $useraddresses->address_type             = $request['address_type'];
            $useraddresses->name                     = $request['name'];
            $useraddresses->mobileno                 = $request['mobileno'];
            $useraddresses->pincode                  = $request['pincode'];
            $useraddresses->locality                 = $request['locality'];
            $useraddresses->address_area_and_street  = $request['address_area_and_street'];
            $useraddresses->city_or_district_or_town = $request['city_or_district_or_town'];
            $useraddresses->state                    = $request['state'];
            $useraddresses->landmark                 = $request['landmark'];
            $useraddresses->alternate_phone          = $request['alternate_phone'];
		$useraddresses->save();

        return redirect()->back()->with('message', 'Addresses added successfully.');
    }


    /**
     * EDIT MY ADDRESSES
     *
     * @return true or false
     */

    public function edit_my_addresses(Request $request, $addressesid)
    {
	   $useraddress = Useraddresses::where("id",Crypt::decryptString($addressesid))->first();
	   return view('dashboardarea.edit-my-addresses',compact('useraddress'));
    }

	public function edit_user_addresses_post(Request $request, $addressesid){
        $this->validate($request, [
            'name'                    => 'required',
            'mobileno'                => 'required',
            'pincode'                 => 'required',

        ],[
            'address_type.name' => 'Please enter name',
            'mobileno.required' => 'Please enter mobile no',
            'pincode.required' => 'Please enter pincode',
        ]);

        $data = array(
                        'address_type'                     => $request['address_type'],
                        'name'                             => $request['name'],
                        'mobileno'                         => $request['mobileno'],
                        'pincode'                          => $request['pincode'],
                        'locality'                         => $request['locality'],
                        'address_area_and_street'          => $request['address_area_and_street'],
                        'city_or_district_or_town'         => $request['city_or_district_or_town'],
                        'state'                            => $request['state'],
                        'landmark'                         => $request['landmark'],
                        'alternate_phone'                  => $request['alternate_phone']
                    );
        Useraddresses::where('id', $addressesid)->update($data);

        return redirect()->back()->with('message', 'Addresses Updated successfully.');
	}

}
