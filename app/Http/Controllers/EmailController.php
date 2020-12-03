<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function store(Request $request){

        $request->validate(
            [
                'issue'=>'required',
                'status'=>'required'
            ]
        );

        $email = $request->input('email');
        $scn = $request->input('scn');
        $status = $request->input('status');
        $name = $request->input('name');
        $issue = $request->input('issue');
        $date = $request->input('date');


        if(!empty($email) or !empty($scn)){



            if(!empty($scn)){
                if(strlen($scn)<9){
                    return back()->withErrors(['Enrollment number not complete'])->withInput();
                }
            }


            $uuid  = (string)Str::uuid();
            DB::beginTransaction();
            $data['email'] = $email;
            $data['scn'] = strtoupper($scn);
            $data['status'] = $status;
            $data['issue'] = $issue;
            $data['name'] = $name;
            $data['call_count'] = 1;
            $data['uuid'] = $uuid;
            $data['active'] = true;
            $data['opened'] = date('Y/m/d');

            if($status==='Resolved'){
                $data['closed'] = date('Y/m/d');
                $data['resolved'] = true;

            }

            if(!empty($date)){
                $data['opened'] = date('Y/m/d', strtotime($date));

                if($status==='Resolved'){
                    $data['closed'] = date('Y/m/d', strtotime($date));
                    $data['resolved'] = true;
                }
            }

            Email::create($data);

            DB::commit();
            return redirect()->route('home')->withMessage('Record Updated');
        }else{
            return back()->withErrors(['One or more required fields are missing'])->withInput();
        }
    }

    public function emails(Request $request){

        $query = Email::orderBy('opened', 'desc')->where('active', true);
        $query = $this->setType($request, $query);
        $query = $this->trySearch($request, $query);

        return view('pages.list_email')->with([
            'data'=>$query->paginate(30),
            'key'=>$request->input('key')
        ]);

    }

    public function trySearch($request, $query){
        $key = $request->input('key');
        if(!empty($key)){
            $query = $query->where('scn', 'LIKE', "%{$key}%")
                ->orWhere('name', 'LIKE', "%{$key}%")
                ->orWhere('email', 'LIKE', "%{$key}%");
        }
        return $query;
    }

    public function setType($request, $query){
        $type = $request->input('type');
        if($type==='unresolved'){
            $query = $query->where('resolved', null)->orwhere('resolved', false);
        }
        return $query;
    }

    public function emailsEdit($uuid){
        $item = Email::whereUuid($uuid)->where('active', true)->first();
        if(!empty($item)){
            return view('pages.edit_email')->with(['item'=>$item]);
        }
        return back()->withErrors(['Resource not found']);
    }

    public function emailsUpdate(Request $request, $uuid){
        $item = Email::whereUuid($uuid)->where('active', true)->first();
        if(!empty($item)){

            $email = $request->input("email");
            $scn = $request->input("scn");
            $issue = $request->input("issue");
            $name = $request->input("name");
            $date = $request->input("date");

            DB::beginTransaction();

            $data['scn'] = $scn;
            $data['issue'] = $issue;
            $data['name'] = $name;
            $data['email'] = $email;
            $data['opened'] = date('Y/m/d', strtotime($date));
            $item->update($data);
            DB::commit();

            return back()->withMessage('Record updated');
        }
        return back()->withErrors(['Resource not found']);
    }
}
