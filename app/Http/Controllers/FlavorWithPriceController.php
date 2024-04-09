<?php

namespace App\Http\Controllers;

use App\Models\Flavor_With_Price;
use App\Models\Flavor;

use Illuminate\Http\Request;

class FlavorWithPriceController
{
    //


    public function flavorprice(){

        $flavorsWithPrices = Flavor_With_Price::with('flavor')->get();
        
      
        
        $flavorprice = $flavorsWithPrices->map(function ($item) {
            return [
                'flavor_with_prices_id' => $item['flavor_with_prices_id'],
                'flavor_name' => $item['flavor'][0]['flavor_name'],
                'flavor_price' => $item['flavor_price'],
                'flavor_description' => $item['flavor'][0]['flavor_description'],
                'flavor_id' => $item['flavor'][0]['flavor_id'],
                'flavor_ingredients' => $item['flavor'][0]['flavor_ingredients'],
                'flavor_image' => $item['flavor'][0]['flavor_image'],
            ];
        });

     
        // $flavorprice = Flavor_With_Price::all();
        $url = "/flavorprice";
        $buttontext = "add flavorprice";
        $flavors = Flavor::all();
        $method = "POST";
       $data = compact("flavorprice","url","buttontext","flavors","method");

        
    return view('admin.uplodeFlavorWithPrice')->with($data);
}


public function uplodeflavorprice(Request $req){



  


    $req->validate([
        'flavor_id' => 'required|integer',
        'flavor_price' => 'required|integer',
    ]);

    $flavor_price = $req->flavor_price;
    $flavor_id = $req->flavor_id;

    $flavorprice = Flavor_With_Price::create([
        'flavor_id' => $flavor_id,
        'flavor_price' => $flavor_price,
    ]);

    if ($flavorprice) {
        return redirect("/flavorprice");
    } else {
        $err = "Failed to create flavorprice";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editflavorprice($id)
{
    $flavorsWithPrices = Flavor_With_Price::with('flavor')->get();
        
      
        
    $flavorprice = $flavorsWithPrices->map(function ($item) {
        return [
            'flavor_with_prices_id' => $item['flavor_with_prices_id'],
            'flavor_name' => $item['flavor'][0]['flavor_name'],
            'flavor_price' => $item['flavor_price'],
            'flavor_description' => $item['flavor'][0]['flavor_description'],
            'flavor_id' => $item['flavor'][0]['flavor_id'],
            'flavor_ingredients' => $item['flavor'][0]['flavor_ingredients'],
            'flavor_image' => $item['flavor'][0]['flavor_image'],
        ];
    });
  
    $flavors = Flavor::all();

    $flavorpriceData = Flavor_With_Price::with('flavor')->find($id);

  
    if ($flavorpriceData) {
        $old_flavor_name = $flavor_name = $flavorpriceData['flavor'][0]['flavor_name'];
        $old_flavor_id = $flavorpriceData->flavor_id;
        $old_flavor_price = $flavorpriceData->flavor_price;
        $buttontext = "Update flavorprice";
        $method = "PATCH";

        $url = "/flavorprice/edit/" . $id;

        $data = compact("flavorprice","old_flavor_id", "url", "old_flavor_name","old_flavor_price", "buttontext","flavors","method");

        return view('admin.uplodeFlavorWithPrice')->with($data);
    } else {
        // Set error message if no flavorprice data is found
        $err = "No flavorprice found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updateflavorprice($id,Request $req){
   

   $flavorprice = Flavor_With_Price::with('flavor')->find($id);


   if($flavorprice){

  

    $flavorprice->flavor_price = $req['flavor_price'];
    $flavorprice->flavor_id = $req['flavor_id'];
    $flavorprice->save();
    return redirect('/flavorprice');

   }else{
    $err = "No flavorprice found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deleteflavorprice($id){

    $flavorprice = Flavor_With_Price::find($id);
    if ($flavorprice) {
        $flavorprice->delete();
        

        return redirect('flavorprice');
    } else {
        $err = "no flavorprice found";
        return redirect()->back()->withErrors([$err]);
    }

}

}
