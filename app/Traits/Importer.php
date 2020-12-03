<?php

namespace App\Traits;

use App\Exports\RecordExport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

trait Importer{

    public function fileUpload($file, $group=null, $allowedfileExtension, $prefix=""){


        if(empty($allowedfileExtension)){
            $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];
        }

        $extension = $file->getClientOriginalExtension();

        $extension = strtolower($extension);

        $size = $file->getClientSize();

        if ($size > 600000) {
            return [false, 'Your passport must be of types : jpeg,bmp,png,jpg.'];
        }

        $time = Carbon::now();

        $check = in_array(strtolower($extension), $allowedfileExtension);

        $filename = Str::random(9) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

        if ($check) {

            $directory = !empty($group)?"data/image_uploads/{$group}":"data/uploads";
            $url = $directory . '/' . $prefix.$filename;

            $file->move(public_path($directory),$filename);
            //store to thumb

            return [true,$url];

        } else {

            return [false, 'Your passport must be of types : jpeg,bmp,png,jpg.'];

        }

    }

}