<?php

namespace App\Utils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;


class ImageUpload
{

    public static function uploadImage($request,$height=null,$width=null,$path=null) {

        // dd($request);
        // dd($request->path());
        $imagename = Str::uuid().date('Y-m-d') . '.' . $request->extension();
        // $height = getimagesize($request);
        [$widthDefault, $heightDefault] = getimagesize($request);
        $height = $height ?? $heightDefault;
        $width = $width ?? $widthDefault;

        // dd($height, $width);
        // dd($imagename);
        $image = Image::make($request->path());
        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        })->stream();
        // dd($logo);
        Storage::disk('images')->put($path.$imagename, $image);
        return $path.$imagename;
    }
}