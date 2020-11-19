<?php

namespace App\Traits;

use App\Exports\RecordExport;
use Maatwebsite\Excel\Facades\Excel;

trait Exporter{

    public function downloadExcel($data, $title, $heading, $filename){
        $export = new RecordExport($data, $title, $heading);

        return Excel::download($export, "$filename.xlsx");
    }

}