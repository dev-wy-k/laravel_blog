<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "photo.*" => "mimetypes:image/jpeg,image/png" 
        ]);

        $fileNameLocation = [];

        foreach($request->file("photo") as $file){
            $newFileName = uniqid()."_profile.".$file->getClientOriginalExtension() ;

            array_push($fileNameLocation, $newFileName);
            $dir = "/public/article" ;
            $file->storeAs($dir, $newFileName);
            // Storage::putFileAs($dir, $file, $newFileName) ;

        }

        foreach($fileNameLocation as $location){

            $photo = new Photo();
            $photo->article_id = $request->article_id ;
            $photo->location = $location ;
            $photo->save();

        }

        return redirect()->back() ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        
        $dir = "/public/article/" ;
        Storage::delete($dir.$photo->location) ;
        $photo->delete();
        return redirect()->back() ;
        
    }
}
