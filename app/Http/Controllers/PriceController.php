<?php

namespace App\Http\Controllers;
use App\Models\Price;

use Illuminate\Http\Request;

class PriceController
{
    //

    public function price(){

        $price = Price::all();
        $url = "/price";
        $buttontext = "add price";
       $data = compact("price","url","buttontext");

        
    return view('admin.uplodeprice')->with($data);
}


public function uplodeprice(Request $req){

    $alreadyExist = Price::where("price_value", $req->price_value)->first();

    if($alreadyExist){
        $err = "price already Exist";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }
    $req->validate([
        'price_value' => 'required|integer|unique:price',
    ]);

    $price_value = $req->price_value;

    $price = Price::create([
        'price_value' => $price_value,
    ]);

    if ($price) {
        return redirect("/price");
    } else {
        $err = "Failed to create price";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editprice($id)
{
    $price = Price::all();

    $priceData = Price::find($id);  

    if ($priceData) {
        $oldprice = $priceData->price_value;
        $buttontext = "Update price";

        $url = "/price/edit/" . $id;

        $data = compact("price", "url", "oldprice", "buttontext");

        return view('admin.uplodeprice')->with($data);
    } else {
        // Set error message if no price data is found
        $err = "No price found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updateprice($id,Request $req){
   
   $price = Price::find($id);




   $req->validate([
    'price_value' => 'required|string|unique:price',
]);




   if($price){

    if ($price->price_value === $req['price_value']) {
        $err = "price Already exists";
        return redirect()->back()->withErrors([$err])->withInput();
    }

    $price->price_value = $req['price_value'];
    $price->save();
    return redirect('/price');

   }else{
    $err = "No price found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deleteprice($id){

    $price = price::find($id);
    if ($price) {
        $price->delete();
        

        return redirect('price');
    } else {
        $err = "no price found";
        return redirect()->back()->withErrors([$err]);
    }

}
}
