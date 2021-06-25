<?php

namespace Modules\MediaUpload\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\MediaUpload\Entities\Upload;
use Illuminate\Support\Facades\File;
use Image;

class MediaUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function mediaupload()
    {
        $files = Upload::simplePaginate(10);
        return view('mediaupload::upload',compact('files'));
    }


    public function filesupload()
    {

        return view('mediaupload::filesupload');
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('mediaupload::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function filesubmit(Request $request)
    {


        if($request->hasFile('file')){
            $requestedfile = $request->file;
            $f = $requestedfile->GetClientOriginalName();
            $filename =time().$requestedfile->GetClientOriginalName();

            $thumbnailImage = Image::make($requestedfile);
            $thumbnailPath = public_path().'/thumbnail/';
            $originalPath = public_path().'/uploads/';
            $thumbnailImage->save($originalPath.time().$requestedfile->getClientOriginalName());
            $thumbnailImage->resize(150,150);
            $thumbnailImage->save($thumbnailPath.time().$requestedfile->getClientOriginalName());


            $size = $requestedfile->getSize();
            $extension = $requestedfile->extension();
            $getFileType = $requestedfile->getMimeType();
            $path = public_path('uploads');
            $requestedfile->move($path,$filename);
            $file = 'uploads/'.$filename;
        }

        if(Auth::check()){
            Upload::create([
                'extension' => $extension,
                'type' => $getFileType,
                'user_id' => Auth::user()->id,
                'fileoriginalname' => pathinfo($f,PATHINFO_FILENAME),
                'filename' => $file,
                'file_size' =>$size
            ]);
        }

        return response()->json([
            'success' => 'Uploaded successfully'
        ]);

        // return redirect()->route('upload')->with('success','Added Successfully');
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('mediaupload::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('mediaupload::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $file = Upload::findOrFail($id);
        if(File::exists(public_path($file->filename))){
            unlink(public_path($file->filename));
            File::delete(public_path($file->filename));
        }
        $file->delete();
        return redirect()->back()->with('success','Deleted Successfully');
        //
    }


    public function search(Request $request){
        if($request->image == "filename"){
            $images = Upload::where('filename', 'like', '%' . $request->img_name . '%');

        }elseif($request->image == "file_size"){
            $images = Upload::where('file_size', 'like', '%' . $request->img_name . '%');
        }elseif($request->image == "extension"){
            $images = Upload::where('extension', 'like', '%' . $request->img_name . '%');
        }else{
            $images = Upload::all();
        }

        $images = $images->get();
        return view('mediaupload::search',compact('images'));
    }
}
