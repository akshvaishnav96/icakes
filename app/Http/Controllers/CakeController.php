<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Tier;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Tag;
use App\Models\CakeSizeWithPrice;
use App\Models\Flavor_With_Price;
use App\Models\Cake;

class CakeController
{
    //
    
    public function cake(){
        $subcategory = SubCategory::all();
        $categorys = Category::all();
        $tags = Tag::all();
        $cakes = Cake::All();


        // foreach ($cakes as $key=> $cakes) {



        //     // [subcategory_ids] => ["1","2","3","4"]

        //  $subCategoryid =  json_decode($cakes->subcategory_ids);

       
        //  foreach ($subCategoryid as $key=> $subCategoryid) {
        //         $subcategory = SubCategory::where('subcategory_id',$subCategoryid)->get();

        //         p($subcategory->toArray());
        //  }





//         $subcategoriesData=[];
        
// foreach ($cakes as $key => $cake) {
//     $subCategoryIds = json_decode($cake->subcategory_ids);

//     $cakeSubcategories = new Collection();

//     foreach ($subCategoryIds as $subCategoryId) {
//         $subcategory = SubCategory::where('subcategory_id', $subCategoryId)->first();
        
//         if ($subcategory) {
//             $cakeSubcategories->push($subcategory);
//         }
//     }

   
//     // echo "Subcategories for Cake $cake->id: <br>";
//     // foreach ($cakeSubcategories as $subcategory) {
//     //     p($subcategory->toArray());
//     // }
//     // echo "<br>";


//     $cakeId = $cake->id;
//     $subcategoriesData[$cakeId] = $cakeSubcategories->toArray();

    
// }


// p($subcategoriesData);
// die;




       

           


        
        // die;
        // p($cakes->toArray());





      
        $CSWP = CakeSizeWithPrice::with('size','tier')->get();
        $cakesizewithprice = $CSWP->map(function ($item) {
            return [
                
                'cake_size_with_prices_id' => $item['cake_size_with_prices_id'],
                'tier_id' => $item['tier_id'],
                'size_id' => $item['size_id'],
                'price' => $item['price'],
                'size_name' => $item['size'][0]['size_name'],
                'tier_name' => $item['tier'][0]['tier_name'],
              
            ];
        });
        $FWP = Flavor_With_Price::with('flavor')->get();
        $flavorwithprice = $FWP->map(function ($item) {
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
        $url = "/cake";
        $buttontext = "add cake";
        $method = "POST";
       $data = compact("subcategory","categorys","tags","cakesizewithprice","flavorwithprice","buttontext","url","method");

        
   
        return view('admin.uplodeCake') ->with($data);;
    }





        public function uplodeCake(Request $req)


            {

              




            $validation = $req->validate([
                'cakename' => 'required|string',
                'productId' => 'required|integer',
                'category_name' => 'required|string',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
              
                'subcategory_ids'=>"required|array",
               'tag_ids'=>"required|array", 
               'cake_size_with_prices_ids'=>"required|array",
               'flavor_with_prices_ids'=>"required|array",
                
            ]);



    
            // Store images and get image paths
            $imagePaths = [];
            foreach ($req->images as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $fileName);
                $imagePaths[] = 'storage/images/' . $fileName;
            }


            Cake::create([
                'cakename' => $req->cakename,
                'productId' => $req->productId,
                'category_name' => $req->category_name,
                'images' => json_encode($imagePaths),
                'discount' => $req->discount,
                'subcategory_ids'=>json_encode($req->subcategory_ids),
               'tag_ids'=>json_encode($req->tag_ids), 
               'cake_size_with_prices_ids'=>json_encode($req->cake_size_with_prices_ids),
               'flavor_with_prices_ids'=>json_encode($req->flavor_with_prices_ids),
            ]);
    
            // $cake = new Cake();
            // $cake->cakename = $req->cakename;
            // $cake->productId = $req->productId;
            // $cake->category_name = $req->category_name;
            // $cake->images = json_encode($imagePaths);
            // $cake->discount = $req->discount;

            // $tagarr = $req->tag_ids;
            // $CSWP_arr = $req->cake_size_with_prices_ids;
            // $FWP = $req->flavor_with_prices_ids;
            // $subcategoryArr = $req->subcategory_ids;

            // $cake->save();
            
            // $cake->subcategory()->attach($subcategoryArr);
            // $cake->tags()->attach($tagarr);
            // $cake->getCakeSizeWithPrice()->attach($CSWP_arr);
            // $cake->getFlavorWithPrice()->attach($FWP);
            
            return redirect('/cake');
    }
    


   
}
