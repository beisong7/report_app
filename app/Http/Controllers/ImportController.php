<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Email;
use App\Models\Phone;
use App\Traits\Importer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    use Importer;

    public function import(){
        return view('pages.import');
    }

    public function startImport(Request $request){
        //dd($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $process = $this->fileUpload($file, null, ['xls', 'xlsx']);

            if($process[0]){
                $location = $process[1];
                $excelFile = public_path($location);
                $result = Excel::toArray(new ExcelImport(), $excelFile);

                //try to unlink imports
                try{
                    unlink($location);
                }catch (\Exception $e){

                }
                DB::beginTransaction();

                $total = count($result[0]);
                $unprocessed = 0;
                if($request->input('channel')==="calls"){
                    foreach ($result[0] as $row){

//                        dd($row);
                        $opened = str_replace("/", "-", $row[0]);
                        $opened = strtotime($opened);

                        if(empty($opened)){
                            $opened = str_replace("/", "-", $row[0]);

                            dd($row, strtotime($opened), $opened);
                        }

                        $comment = preg_replace('/[^A-Za-z0-9.\_-]/', ' ', strtolower($row[5]));
                        $phone['uuid'] =  (string)Str::uuid();
                        $phone['scn'] =  $row[4];
                        $phone['comment'] = $comment;

                        $phone['name'] = $row[1];
                        $phone['phone'] = is_numeric($row[3])?"0{$row[3]}":$row[3];
                        $phone['resolved'] = true;
                        $phone['active'] = false;
                        $phone['opened'] = date("Y-m-d", $opened);
                        $phone['closed'] = date("Y-m-d", strtotime($row[0]));
                        $phone['status'] = "Resolved";

                        if(strpos($comment, "password") !== false){
                            $phone['issue'] = "Password Reset";
                            $phone['active'] = true;
                        }
                        elseif(strpos($comment, "reset") !== false){
                            $phone['issue'] = "Password Reset";
                            $phone['active'] = true;
                        }
                        elseif(strpos($comment, "phone") !== false){
                            $phone['issue'] = "Wrong NBA Phone Number";
                            $phone['active'] = true;
                        }
                        elseif(strpos($comment, "login") !== false){
                            $phone['issue'] = "Login Enquiry";
                            $phone['active'] = true;
                        }
                        elseif(strpos($comment, "inquiry") !== false){
                            $phone['issue'] = "Enquiry";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "inactive") !== false){
                            $phone['issue'] = "Reactivation";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "otp") !== false){
                            $phone['issue'] = "OTP";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "link") !== false){
                            $phone['issue'] = "Registration Link";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "stuck") !== false){
                            $phone['issue'] = "Stuck In Approved";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "approved") !== false){
                            $phone['issue'] = "Stuck In Approved";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "invalid") !== false){
                            $phone['issue'] = "Invalid Enrollment Number";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "fail") !== false){
                            $phone['issue'] = "Failed Registration";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "decomissioned") !== false){
                            $phone['issue'] = "Reactivation";
                            $phone['active'] = true;
                        }elseif(strpos($comment, "update") !== false){
                            $phone['issue'] = "Profile Update";
                            $phone['active'] = true;
                        }
                        else{
                            $phone['active'] = false;
                            $unprocessed++;
                        }
//                        dd($phone);
                        Phone::create($phone);


                    }

                }else{

                    foreach ($result[0] as $row){

                    }
                }

//                dd($total, $unprocessed, $total - $unprocessed);

                DB::commit();
                $processed = $total - $unprocessed;
                return ["Total {$total}, Unprocessed {$unprocessed}, Processed {$processed}"];
            }
        }
    }

    public function deleteEntry(){
        $today = date('Y/m/d');
        $count = Phone::where('created_at', '>', $today)->get()->count();
        $phones = Phone::where('created_at', '>', $today)->get();
        foreach ($phones as $phone){
            $phone->delete();
        }
        dd($count);
    }

    public function updateOldRecords(){
        $phones = Phone::where('active', null)->get();
        foreach ($phones as $phone){
            $phone->active = true;
            $phone->update();
        }
        $emails = Email::where('active', null)->get();
        foreach ($emails as $email){
            $email->active = true;
            $email->update();
        }
    }
}
