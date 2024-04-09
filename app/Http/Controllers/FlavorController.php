<?php

namespace App\Http\Controllers;
use App\Models\Flavor;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class FlavorController
{
    //

    public function flavor(){

        $flavor = Flavor::all();
        $url = "/flavor";
        $buttontext = "add flavor";
        $method = "POST";
       $data = compact("flavor","url","buttontext","method");

        
    return view('admin.uplodeFlavor')->with($data);
}


public function uplodeflavor(Request $req){



    $alreadyExist = Flavor::where("flavor_name", $req->flavor_name)->first();

    if($alreadyExist){
        $err = "flavor already Exist";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }


    $req->validate([
        'flavor_name' => 'required|string|unique:flavor',
        'flavor_description' => 'required|string',
        'flavor_ingredients' => 'required|string',
        'flavor_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
    ]);



    $flavor_name = $req->flavor_name;
    $flavor_description = $req->flavor_description;
    $flavor_ingredients = $req->flavor_ingredients;


   $fileName = 'custom_name_' . time() . '.' . $req->flavor_image->getClientOriginalExtension();
   $flavor_image = $req->file('flavor_image')->storeAs('uploads', $fileName,'public');

    $flavor = Flavor::create([
        'flavor_name' => $flavor_name,
        'flavor_description' => $flavor_description,
        'flavor_ingredients' => $flavor_ingredients,
        'flavor_image' => $flavor_image,
    ]);

    if ($flavor) {
        return redirect("/flavor");
    } else {
        $err = "Failed to create flavor";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editflavor($id)
{
    $flavor = Flavor::all();

    $flavorData = Flavor::find($id);  

    if ($flavorData) {
        $flavor_name = $flavorData->flavor_name;
        $flavor_description = $flavorData->flavor_description;
        $flavor_ingredients = $flavorData->flavor_ingredients;
        $buttontext = "Update flavor";
        $method = "PATCH";
        $url = "/flavor/edit/" . $id;

        $data = compact("flavor", "url", "flavor_name","flavor_description","flavor_ingredients", "buttontext" ,"method");

        return view('admin.uplodeFlavor')->with($data);
    } else {
        // Set error message if no flavor data is found
        $err = "No flavor found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updateflavor($id,Request $req){

    $flavor = Flavor::find($id);
   
   

    if ($flavor) {
        if ($flavor->flavor_name !== $req['flavor_name']) {
            $existingFlavor = Flavor::where('flavor_name', $req['flavor_name'])->first();
            if ($existingFlavor) {
                $err = "Flavor already exists";
                return redirect()->back()->withErrors([$err])->withInput();
            }
        }
        $flavor->flavor_name = $req['flavor_name'];
        $flavor->flavor_description = $req['flavor_description'];
        $flavor->flavor_ingredients = $req['flavor_ingredients'];

    if($req['flavor_image']){

        $fileName =  time() . '.' . $req->flavor_image->getClientOriginalExtension();
        $flavor_image = $req->file('flavor_image')->storeAs('uploads', $fileName,'public');
        if ($flavor->flavor_image && Storage::disk('public')->exists($flavor->flavor_image)) {
         
            Storage::disk('public')->delete($flavor->flavor_image);
        }
        $flavor->flavor_image = $flavor_image;
}



        $flavor->save();

        return redirect('/flavor');


   }else{
    $err = "No flavor found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deleteflavor($id){

    $flavor = Flavor::find($id);
    if ($flavor) {
        $flavor->delete();
        

        return redirect('flavor');
    } else {
        $err = "no flavor found";
        return redirect()->back()->withErrors([$err]);
    }

}
}
