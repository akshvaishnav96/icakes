<?php

namespace App\Http\Controllers;
use App\Models\Size;

use Illuminate\Http\Request;

class SizeController
{
    //
    public function size()
    {
        $size = Size::all();
        $url = "/size";
        $buttontext = "add size";
        $data = compact("size", "url", "buttontext");
        return view("admin.uplodesize")->with($data);
    }










    // =========

    public function uplodesize(Request $req)
    {

        $alreadyExist = Size::where("size_name", $req->size_name)->first();

        if ($alreadyExist) {
            $err = "size already Exist";
            return redirect()->back()->withErrors(['err' => $err])->withInput();
        }
        $req->validate([
            'size_name' => 'required|string|unique:size',
            'description' => 'required|string',
        ]);




        $size_name = $req->size_name;
        $description= $req->description;

        $size = Size::create([
            'size_name' => $size_name,
            'description' => $description,
        ]);



        if ($size) {
            return redirect("/size");
        } else {
            $err = "Failed to create tag";
            return redirect()->back()->withErrors(['err' => $err])->withInput();
        }
    }


    public function editsize($id)
    {
        $size = Size::all();

        $sizeData = Size::find($id);

        if ($sizeData) {
            $oldsize = $sizeData->size_name;
            $description = $sizeData->description;
            $buttontext = "Update size";

            $url = "/size/edit/" . $id;

            $data = compact("size", "url", "oldsize", "buttontext","description");

            return view('admin.uplodesize')->with($data);
        } else {
            // Set error message if no tag data is found
            $err = "No tags found";
            return redirect()->back()->withErrors($err)->withInput();
        }
    }



    public function updatesize($id, Request $req)
    {

        $size = Size::find($id);

        $req->validate([
            'size_name' => 'required|string',
            'description'=>  'required' // Adjust the validation rules as needed
        ]);




        if ($size) {



   
        if ($size->size_name !== $req['size_name']) {
            $existingsize = Size::where('size_name', $req['size_name'])->first();
            if ($existingsize) {
                $err = "Size already exists";
                return redirect()->back()->withErrors([$err])->withInput();
            }
        }

          

          
            $size->size_name = $req['size_name'];
            $size->description = $req['description'];
            $size->save();
            return redirect('/size');
        } else {
            $err = "No tags found";
            return redirect()->back()->withErrors([$err])->withInput();
        }
    }


    public function deletesize($id)
    {

        $size = Size::find($id);
        if ($size) {
            $size->delete();


            return redirect('size');
        } else {
            $err = "no size found";
            return redirect()->back()->withErrors([$err]);
        }
    }
}
