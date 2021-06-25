<?php

namespace Modules\SiteSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SiteSetting\Entities\Sitesetting;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $favicon = Sitesetting::where('key','fav_icon')->first();
        // $favicon = Sitesetting::where('key','fav_icon')->pluck('value','key')->toArray();
        $siteicon = Sitesetting::where('key','site_icon')->first();
        // $siteicon = Sitesetting::where('key','site_icon')->pluck('value','key')->toArray();
        $description = Sitesetting::where('key','description')->pluck('value','key')->toArray();
        $title = Sitesetting::where('key','title')->pluck('value','key')->toArray();
        return view('sitesetting::index',compact('favicon','siteicon','description','title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sitesetting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fav_icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->file('icon')){
            $s = Sitesetting::where('key','site_icon')->first();
            if($s){

                $siteicon = public_path($s->value);
                if(File::exists($siteicon)){
                    File::delete($siteicon);
                }
            }
            $request['site_icon'] = $this->imageUpload($request->icon);

        }
        if($request->file('favicon')){
            $f = Sitesetting::where('key','fav_icon')->first();
            if($f){

                $favicon = public_path($f->value);
                if(File::exists($favicon)){
                    File::delete($favicon);
                }
            }
            $request['fav_icon'] = $this->imageUpload($request->favicon);
        }

        $inputs = $request->only('description','title','site_icon', 'fav_icon');
        foreach($inputs as $key => $input){
            Sitesetting::updateOrCreate(['key'=>$key],[
                    'value' => $input,
                ]);
        }

        return redirect()->back()->with('success','updated successfully');

    }

    public function imageUpload($image){
        $requestedimage = $image;
        $imagename = time().$requestedimage->GetCLientOriginalName();
        $path = public_path('uploads');
        $requestedimage->move($path,$imagename);
        return 'uploads/'.$imagename;


        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sitesetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sitesetting::edit');
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
        //
    }
}
