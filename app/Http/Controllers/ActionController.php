<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    public function toggleState(Request $request){
        $type = $request->input('type');
        $uuid = $request->input('uuid');

        if($type==='mail'){
            $item = Email::whereUuid($uuid)->where('active', true)->first();
            return $this->toggleItem($uuid, $item);
        }else{
            $item = Phone::whereUuid($uuid)->where('active', true)->first();
            return $this->toggleItem($uuid, $item);
        }
    }

    function toggleItem($uuid, $item){

        if(!empty($item)){
            $msg = "";
            $data = null;
            DB::beginTransaction();
            if($item->resolved){
                $msg = "Record updated as not resolved";
                $data['resolved'] = false;
                $data['status'] = 'Not Resolved';
            }else{
                $msg = "Record updated as resolved";
                $data['resolved'] = true;
                $data['status'] = 'Resolved';
            }
            $item->update($data);
            DB::commit();
            return back()->withMessage($msg);
        }
        return back()->withErrors(['Resource not found']);
    }

}
