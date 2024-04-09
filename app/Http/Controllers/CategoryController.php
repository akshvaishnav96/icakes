<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController
{
    //
    public function category()
    {
        $category = Category::all();
        $url = "/category";
        $buttontext = "add category";
        $data = compact("category", "url", "buttontext");
        return view("admin.uplodeCategory")->with($data);
    }










    // =========

    public function uplodeCategory(Request $req)
    {

        $alreadyExist = Category::where("category_name", $req->category_name)->first();

        if ($alreadyExist) {
            $err = "Category already Exist";
            return redirect()->back()->withErrors(['err' => $err])->withInput();
        }
        $req->validate([
            'category_name' => 'required|string|unique:categories',
        ]);




        $category_name = $req->category_name;

        $category = Category::create([
            'category_name' => $category_name,
        ]);

        if ($category) {
            return redirect("/category");
        } else {
            $err = "Failed to create tag";
            return redirect()->back()->withErrors(['err' => $err])->withInput();
        }
    }


    public function editCategory($id)
    {
        $category = Category::all();

        $cakeData = Category::find($id);

        if ($cakeData) {
            $oldcake = $cakeData->category_name;
            $buttontext = "Update Category";

            $url = "/category/edit/" . $id;

            $data = compact("category", "url", "oldcake", "buttontext");

            return view('admin.uplodeCategory')->with($data);
        } else {
            // Set error message if no tag data is found
            $err = "No tags found";
            return redirect()->back()->withErrors($err)->withInput();
        }
    }



    public function updateCategory($id, Request $req)
    {

        $category = Category::find($id);

        $req->validate([
            'category_name' => 'required|string|unique:categories', // Adjust the validation rules as needed
        ]);




        if ($category) {

            if ($category->category_name === $req['category_name']) {
                $err = "category Already exists";
                return redirect()->back()->withErrors([$err])->withInput();
            }

            $category->category_name = $req['category_name'];
            $category->save();
            return redirect('/category');
        } else {
            $err = "No tags found";
            return redirect()->back()->withErrors([$err])->withInput();
        }
    }


    public function deleteCategory($id)
    {

        $category = Category::find($id);
        if ($category) {
            $category->delete();


            return redirect('category');
        } else {
            $err = "no category found";
            return redirect()->back()->withErrors([$err]);
        }
    }
}
