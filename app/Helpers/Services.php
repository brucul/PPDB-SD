<?php

// use App\Models\Category;

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


function resize_image($file, $width, $height, $path)
{
    $img = Image::make($file->path());
    $img->resize($width, $height, function($constraint) {
        $constraint->aspectRatio();
    })->save($path);

    return $img;
}

function delete_image($image)
{
    if (Storage::exists($image)) {
        Storage::delete($image);
    }

    return true;
}

function make_directory($dir)
{
    if (!File::isDirectory($dir)) {
        File::makeDirectory($dir);
    }

    return true;
}

function delete_directory($dir)
{
    if (File::isDirectory($dir)) {
        File::deleteDirectory($dir);
    }

    return true;
}

function dateToIndo($date)
{
    $time = Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM Y');
    return $time;
}

function getSetting()
{
    return Setting::find(1);
}