<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsermanagementController extends Controller
{
    public function index()
    {

        $users = User::orderBy('firstname', 'ASC')->get();


        return view('pages.user-management',compact('users'));
    }

    public function add(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $pass1 = $request->pass1;
        $pass2 = $request->pass2;
        $role = $request->role;

        if(empty($name)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        if(empty($email)){
            return response()->json(['Error'=>1, 'message'=>'Empty Email']);
        }
        if(empty($pass1) || empty($pass2)){
            return response()->json(['Error'=>1, 'message'=>'Empty Password']);
        }
        if($pass1 != $pass2){
            return response()->json(['Error'=>1, 'message'=>'Password is not Match']);
        }
        if(empty($role)){
            return response()->json(['Error'=>1, 'message'=>'Empty Role']);
        }
        
        $user = User::where('email','=',$email)->first();

        if(!empty($user)){
            return response()->json(['Error'=>1, 'message'=>'Email Already Exist']);
        }

        $data = [
            'firstname'=> $name,
            'email'=> $email,
            'password'=> $pass1,
            'role'=> $role
        ];

        $user = User::create($data);
        if($user){
            return response()->json(['Error'=> 0,'message'=>'New user added']);
        }


    }

    public function delete(Request $request){
        $id = $request->id;

        $delete = User::where('id',$id)->delete();

        if($delete){
            return response()->json(['Error'=>0,'message'=>'User Deleted']);
        }
        return response()->json(['Error'=>1,'message'=>'Deleting Failed']);

    }

    public function edit(Request $request){
        $id = $request->id;
        $ename = $request->ename;
        $eemail = $request->eemail;
        $erole = $request->erole;
        $epass1 = $request->epass1;
        $epass2 = $request->epass2;

        if(empty($ename)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        if(empty($eemail)){
            return response()->json(['Error'=>1, 'message'=>'Empty Email']);
        }
        if(empty($erole)){
            return response()->json(['Error'=>1, 'message'=>'Empty Role']);
        }
        if($epass1 != $epass2){
            return response()->json(['Error'=>1, 'message'=>'Password is not Match']);
        }

        $chckuser = User::where('email','=',$eemail)
                        ->where('id','!=',$id)
                        ->first();

        if(!empty($chckuser)){
            return response()->json(['Error'=>1,'message'=>'Email Already Exist']);
        }

        $data = [
            'firstname'=>$ename,
            'email'=>$eemail,
            'role'=>$erole,
            'password'=>bcrypt($epass1)
        ];
        if(empty($epass1) || empty($epass2)){
            $data = [
                'firstname'=>$ename,
                'email'=>$eemail,
                'role'=>$erole,
            ];
        }
        

        $update = User::where('id',$id)->update($data);
        if($update){
            return response()->json(['Error'=>0,'message'=>'Update Successful']);
        }

    }


    public function detail(Request $request){
        $id = $request->id;

        $details = User::where('id','=',$id)->first();
        return response()->json([
            'firstname'=>$details->firstname,
            'lastname'=>$details->lastname,
            'email'=>$details->email,
            'role'=>$details->role,
            'id'=>$id
        ]);
    }



}
