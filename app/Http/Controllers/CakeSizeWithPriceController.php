<?php

namespace App\Http\Controllers;
use App\Models\CakeSizeWithPrice;
use App\Models\Tier;
use App\Models\Size;


use Illuminate\Http\Request;

class CakeSizeWithPriceController
{
    //


    public function cakesizewithprice(){

        $cakewithprice = CakeSizeWithPrice::with('size','tier')->get();
        



        $cakesizewithprice = $cakewithprice->map(function ($item) {
            return [

                'id' => $item['id'],
                'tier_id' => $item['tier_id'],
                'size_id' => $item['size_id'],
                'price' => $item['price'],
                'size_name' => $item['size'][0]['size_name'],
                'tier_name' => $item['tier'][0]['tier_name'],
              
            ];
        });


        $tier = Tier::all();
        $size = Size::all();


        $url = "/cakesizewithprice";
        $buttontext = "add cake size";
        $method = "POST";
       $data = compact("tier","url","buttontext","size","method",'cakesizewithprice');

        
    return view('admin.uplodeCakeSizeWithPrice')->with($data);
}


public function uplodecakesizewithprice(Request $req){




  


    $req->validate([
        'tier_id' => 'required|integer',
        'size_id' => 'required|integer',
        'price' => 'required|integer',
    ]);

    $price = $req->price;
    $size_id = $req->size_id;
    $tier_id = $req->tier_id;

    $cakesizeprice = CakeSizeWithPrice::create([
        'tier_id' => $tier_id,
        'size_id' => $size_id,
        'price' => $price,
    ]);

    if ($cakesizeprice) {
        return redirect("/cakesizewithprice");
    } else {
        $err = "Failed to create flavorprice";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editcakesizewithprice($id)
{

    $cakewithprice = CakeSizeWithPrice::with('size','tier')->get();
        



    $cakesizewithprice = $cakewithprice->map(function ($item) {
        return [

            'id' => $item['id'],
            'tier_id' => $item['tier_id'],
            'size_id' => $item['size_id'],
            'price' => $item['price'],
            'size_name' => $item['size'][0]['size_name'],
            'tier_name' => $item['tier'][0]['tier_name'],
          
        ];
    });


    $tier = Tier::all();
    $size = Size::all();



    
   
    $existCakeSizeWithPrice = CakeSizeWithPrice::with('size','tier')->find($id); 
    

    

    if ($existCakeSizeWithPrice) {
       
        $old_size_id = $existCakeSizeWithPrice->size_id;
        $old_tier_id = $existCakeSizeWithPrice->tier_id;
        $old_price = $existCakeSizeWithPrice->price;
        $old_size_name = $existCakeSizeWithPrice['size'][0]['size_name'];
        $old_tier_name = $existCakeSizeWithPrice['tier'][0]['tier_name'];

       
        $buttontext = "Update cake size";
        $method = "PATCH";

        $url = "/cakesizewithprice/edit/" . $id;

        $data = compact( "url", "old_size_id","old_price","old_tier_id","old_tier_name","old_size_name", "buttontext","cakesizewithprice","method","size","tier");

        return view('admin.uplodeCakeSizeWithPrice')->with($data);


    } else {
        // Set error message if no flavorprice data is found
        $err = "No flavorprice found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updatecakesizewithprice($id,Request $req){
   
 
    $existCakeSizeWithPrice = CakeSizeWithPrice::with('size','tier')->find($id); 

    $req->validate([
        'tier_id' => 'required|integer',
        'size_id' => 'required|integer',
        'price' => 'required|integer',
    ]);



   if($existCakeSizeWithPrice){

  

    $existCakeSizeWithPrice->size_id = $req['size_id'];
    $existCakeSizeWithPrice->tier_id= $req['tier_id'];
    $existCakeSizeWithPrice->price= $req['price'];
    $existCakeSizeWithPrice->save();
    return redirect('/cakesizewithprice');

   }else{
    $err = "No flavorprice found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deletecakesizewithprice($id){

    $existCakeSizeWithPrice = CakeSizeWithPrice::find($id); 
    if ($existCakeSizeWithPrice) {
        $existCakeSizeWithPrice->delete();
        

        return redirect('cakesizewithprice');
    } else {
        $err = "no CakeSizeWithPrice found";
        return redirect()->back()->withErrors([$err]);
    }

}
}
