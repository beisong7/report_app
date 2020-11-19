<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use App\Traits\Exporter;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    use Exporter;

    public function exportData(Request $request, $type){

        $query = $this->setModel(strtolower($type));
        $data = $query->select([
            'issue',
            'status',
            'opened',
            'closed',
            'scn',
            'id',
        ])->get();
        $headings = [
            'Issue',
            'Status',
            'Opened',
            'Closed',
            'Enrollment',
            'ID',
        ];
        return $this->downloadExcel($data->toArray(), "All {$type}", $headings, "all-{$type}");

    }

    function setModel($type){
        if($type==='phone'){
            return Phone::orderBy('opened', 'asc');
        }else{
            return Email::orderBy('opened', 'asc');
        }
    }


}
