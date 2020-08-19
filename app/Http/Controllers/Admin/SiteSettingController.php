<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteSettings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $siteSettings = SiteSettings::all();
        return view('admin.siteSettings.index', compact('siteSettings'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'site_name' => 'max:255',
            'facebook_link' => 'url',
            'twitter_link' => 'url',
            'github_link' => 'url',
            'phone' => 'numeric|min:11',
            'address' => 'max:255',
            'key_words' => 'min:11',
            'description' => 'max:500',
            'main_slider' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'copy_right' => 'max:255',

        ];
        $this->validate($request, $rules);

        $settings = SiteSettings::first();

        $settings->update($request->all());

        if ($request->hasFile('main_slider')) {

            $dim = getimagesize($request->file('main_slider'));
            $width = $dim[0];
            $height = $dim[1];
            $path = public_path();
            $destinationPath = $path . '/images/slider/';
            if (file_exists($destinationPath . $settings->main_slider)) {
                unlink($destinationPath . $settings->main_slider);
            }
            $image = $request->file('main_slider');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $settings->main_slider = $name;
            $settings->save();

            if($width != 1600 && $height != 500)
            {
                $imagePath = $destinationPath. $name;
                Image::make($destinationPath. $name)->resize(1600, 500)->save($imagePath, 100);
            }
        }

        return redirect(route('setting.index'))->withFlashMessage('تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
