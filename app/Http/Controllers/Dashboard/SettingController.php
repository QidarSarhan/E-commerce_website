<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingUpdateRequest;
use App\Models\Setting;
use App\Utils\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
// use Intervention\Image\Facades\Image;


class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        // dd($request->all());
        // $setting = Setting::first();
        // $setting->name = $request->name;
        // dd($setting->id);
        // dd($setting);
        // $setting->update($request->except('logo', 'favicon'));

        $setting->update($request->validated());

        // ImageUpload::uploadImage();

        if($request->has('logo')) {
            $logo = ImageUpload::uploadImage($request->logo, null, null, 'logo/');
            $setting->update(['logo' => $logo]);
            // dd($logo);
        }
        if($request->has('favicon')) {
            $favicon = ImageUpload::uploadImage($request->favicon, 32, 32, 'favicon/');
            $setting->update(['favicon' => $favicon]);
        }
        // $imagename = date('Y-m-d') . '.' . $request->logo->extension();
        // $logo = Image::make($request->logo->path());
        // $logo->fit(200, 200, function ($constraint) {
        //     $constraint->upsize();
        // })->stream();
        // // dd($logo);
        // Storage::disk('public')->put($imagename, $logo);
        // $setting->update(['logo' => 'public/' . $imagename]);


        return redirect()->route('dashboard.settings.index')->with('success', 'تم تحديث الاعدادات بنجاح');
    }
}


// service repository
// categories CategoryService CateegoryRepository

