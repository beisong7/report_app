<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PhoneController extends Controller
{
    //
    public function store(Request $request){


        $request->validate(
            [
                'issue'=>'required',
                'status'=>'required'
            ]
        );

        $phone = $request->input('phone');
        $scn = $request->input('scn');
        $status = $request->input('status');
        $name = $request->input('name');
        $issue = $request->input('issue');
        $date = $request->input('date');

        if(!empty($phone) or !empty($scn)){



            if(!empty($scn)){
                if(strlen($scn)<9){
                    return back()->withErrors(['Enrollment number not complete'])->withInput();
                }
            }

            $uuid  = (string)Str::uuid();
            DB::beginTransaction();
            $data['phone'] = $phone;
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

            Phone::create($data);

            DB::commit();
            return redirect()->route('home')->withMessage('Record Updated');
        }else{
            return back()->withErrors(['One or more required fields are missing'])->withInput();
        }
    }

    public function phones(Request $request){

        $query = Phone::orderBy('opened', 'desc')->where('active', true);
        $query = $this->setType($request, $query);
        $query = $this->trySearch($request, $query);

        return view('pages.list_phone')->with([
            'data'=>$query->paginate(30),
            'key'=>$request->input('key')
        ]);
    }

    public function trySearch($request, $query){
        $key = $request->input('key');
        if(!empty($key)){
            $query = $query->where('scn', 'LIKE', "%{$key}%")
                ->orWhere('name', 'LIKE', "%{$key}%")
                ->orWhere('phone', 'LIKE', "%{$key}%");
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

    public function phonesEdit($uuid){
        $item = Phone::whereUuid($uuid)->where('active', true)->first();
        if(!empty($item)){
            return view('pages.edit_phone')->with(['item'=>$item]);
        }
        return back()->withErrors(['Resource not found']);
    }

    public function phonesUpdate(Request $request, $uuid){

        $item = Phone::whereUuid($uuid)->where('active', true)->first();
        if(!empty($item)){
            $phone = $request->input("phone");
            $scn = $request->input("scn");
            $issue = $request->input("issue");
            $name = $request->input("name");
            $date = $request->input("date");

            DB::beginTransaction();

            $data['scn'] = $scn;
            $data['issue'] = $issue;
            $data['name'] = $name;
            $data['phone'] = $phone;
            $data['opened'] = date('Y/m/d', strtotime($date));
            $item->update($data);
            DB::commit();
            return back()->withMessage('Record updated');
        }
        return back()->withErrors(['Resource not found']);
    }

    public function updateUnfiltered(Request $request){
        $uuid = $request->input('uuid');
        $issue = $request->input('issue');

        $phone = Phone::where('uuid', $uuid)->where('active', false)->first();
        if(!empty($phone)){
            $data['issue'] = $issue;
            $data['active'] = true;
            DB::beginTransaction();
            $phone->update($data);
            DB::commit();
            return redirect()->route('unfiltered')->withMessage('One Unfiltered record updated');
        }
        return back()->withErrors(['Resource not found']);
    }

}
