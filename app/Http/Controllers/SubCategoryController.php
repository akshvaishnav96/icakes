<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;

use Illuminate\Http\Request;

class SubCategoryController
{
    //


    public function subcategory(){

        $subcategory = SubCategory::all();
        $url = "/subcategory";
        $buttontext = "add subcategory";
        $categorys = Category::all();
        $method = "POST";
       $data = compact("subcategory","url","buttontext","categorys","method");

        
    return view('admin.uplodesubcategory')->with($data);
}


public function uplodesubcategory(Request $req){

    $alreadyExist = SubCategory::where("subcategory_name", $req->subcategory_name)->first();

    if($alreadyExist){
        $err = "subcategory already Exist";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }
    $req->validate([
        'subcategory_name' => 'required|string|unique:subcategories',
        'category_name' => 'required|string',
    ]);

    $subcategory_name = $req->subcategory_name;
    $category = $req->category_name;

    $subcategory = SubCategory::create([
        'subcategory_name' => $subcategory_name,
        'category' => $category,
    ]);

    if ($subcategory) {
        return redirect("/subcategory");
    } else {
        $err = "Failed to create subcategory";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editsubcategory($id)
{
    $subcategory = SubCategory::all();
    $categorys = Category::all();

    $subcategoryData = SubCategory::find($id);  

    if ($subcategoryData) {
        $oldsubcategory = $subcategoryData->subcategory_name;
        $oldcategory = $subcategoryData->category;
        $buttontext = "Update subcategory";
        $method = "PATCH";

        $url = "/subcategory/edit/" . $id;

        $data = compact("subcategory", "url", "oldsubcategory","oldcategory", "buttontext","categorys","method");

        return view('admin.uplodesubcategory')->with($data);
    } else {
        // Set error message if no subcategory data is found
        $err = "No subcategory found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updatesubcategory($id,Request $req){
   
   $subcategory = SubCategory::find($id);



   if($subcategory){

  

    $subcategory->subcategory_name = $req['subcategory_name'];
    $subcategory->category = $req['category_name'];
    $subcategory->save();
    return redirect('/subcategory');

   }else{
    $err = "No subcategory found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deletesubcategory($id){

    $subcategory = SubCategory::find($id);
    if ($subcategory) {
        $subcategory->delete();
        

        return redirect('subcategory');
    } else {
        $err = "no subcategory found";
        return redirect()->back()->withErrors([$err]);
    }

}

}
