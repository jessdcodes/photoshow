<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
class PhotosController extends Controller
{
    public function create($album_id){
      return view('photos.create')->with('album_id', $album_id);
    }

    public function store(Request $request){
      $this->validate($request,[
        'title' => 'required',
        'photo' => 'image|max:1999'
      ]);

      // get file name with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();

      // get file name without extension
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // get file extension
      $extension = $request->file('photo')->getClientOriginalExtension();

      //generate new file namespace
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      //upload imagearc
      $path = $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

      //upload photo
      $photo = new Photo;
      $photo->title = $request->input('title');
      $photo->album_id = $request->input('album_id');
      $photo->description = $request->input('description');
      $photo->size = $request->file('photo')->getClientSize();
      $photo->photo = $filenameToStore;

      $photo->save();
      return redirect('/albums')->with('success','Photo Uploaded');
    }
}
