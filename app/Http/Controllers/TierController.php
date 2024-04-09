<?php

namespace App\Http\Controllers;
use App\Models\Tier;

use Illuminate\Http\Request;

class TierController
{
    //

    public function tier(){

        $tier = Tier::all();
        $url = "/tier";
        $buttontext = "add tier";
       $data = compact("tier","url","buttontext");

        
    return view('admin.uplodeTier')->with($data);
}


public function uplodeTier(Request $req){

    $alreadyExist = Tier::where("tier_name", $req->tier_name)->first();

    if($alreadyExist){
        $err = "tier already Exist";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }
    $req->validate([
        'tier_name' => 'required|integer|unique:tiers',
    ]);

    $tier_name = $req->tier_name;

    $tier = Tier::create([
        'tier_name' => $tier_name,
    ]);

    if ($tier) {
        return redirect("/tier");
    } else {
        $err = "Failed to create tier";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function edittier($id)
{
    $tier = Tier::all();

    $tierData = Tier::find($id);  

    if ($tierData) {
        $oldtier = $tierData->tier_name;
        $buttontext = "Update tier";

        $url = "/tier/edit/" . $id;

        $data = compact("tier", "url", "oldtier", "buttontext");

        return view('admin.uplodeTier')->with($data);
    } else {
        // Set error message if no tier data is found
        $err = "No tier found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updatetier($id,Request $req){
   
   $tier = Tier::find($id);




   $req->validate([
    'tier_name' => 'required|string|unique:tiers',
]);




   if($tier){

    if ($tier->tier_name === $req['tier_name']) {
        $err = "Tier Already exists";
        return redirect()->back()->withErrors([$err])->withInput();
    }

    $tier->tier_name = $req['tier_name'];
    $tier->save();
    return redirect('/tier');

   }else{
    $err = "No tier found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deletetier($id){

    $tier = Tier::find($id);
    if ($tier) {
        $tier->delete();
        

        return redirect('tier');
    } else {
        $err = "no tier found";
        return redirect()->back()->withErrors([$err]);
    }

}
}
