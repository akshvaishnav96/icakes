<?php

namespace App\Http\Controllers;
use App\Models\Tag;

use Illuminate\Http\Request;

class TagsController
{
    //

    public function tags(){

        $tag = Tag::all();
        $url = "/tags";
        $buttontext = "add tag";
       $data = compact("tag","url","buttontext");

        
    return view('admin.uplodeTags')->with($data);
}


public function uplodeTags(Request $req){

    $alreadyExist = Tag::where("tag_name", $req->tag_name)->first();

    if($alreadyExist){
        $err = "Tag already Exist";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }
    $req->validate([
        'tag_name' => 'required|string|unique:tag',
    ]);

    $tag_name = $req->tag_name;

    $tag = Tag::create([
        'tag_name' => $tag_name,
    ]);

    if ($tag) {
        return redirect("/tags");
    } else {
        $err = "Failed to create tag";
        return redirect()->back()->withErrors(['err' => $err])->withInput();
    }

}


public function editTags($id)
{
    $tag = Tag::all();

    $tagData = Tag::find($id);  

    if ($tagData) {
        $oldtag = $tagData->tag_name;
        $buttontext = "Update Tag";

        $url = "/tags/edit/" . $id;

        $data = compact("tag", "url", "oldtag", "buttontext");

        return view('admin.uplodeTags')->with($data);
    } else {
        // Set error message if no tag data is found
        $err = "No tags found";
        return redirect()->back()->withErrors($err)->withInput();
    }
}



public function updatetags($id,Request $req){
   
   $tag = Tag::find($id);




   $req->validate([
    'tag_name' => 'required|string|unique:tag', // Adjust the validation rules as needed
]);




   if($tag){

    if ($tag->tag_name === $req['tag_name']) {
        $err = "Tag Already exists";
        return redirect()->back()->withErrors([$err])->withInput();
    }

    $tag->tag_name = $req['tag_name'];
    $tag->save();
    return redirect('/tags');

   }else{
    $err = "No tags found";
    return redirect()->back()->withErrors([$err])->withInput();
   }
}


public function deleteTags($id){

    $tags = Tag::find($id);
    if ($tags) {
        $tags->delete();
        

        return redirect('tags');
    } else {
        $err = "no tags found";
        return redirect()->back()->withErrors([$err]);
    }

}
}
