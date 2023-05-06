<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Itemtype;
use App\Models\Storebranch;
use App\Http\Controllers\AESCipher;
use App\Http\Controllers\LogsController;


class UsermanagementController extends Controller
{
    protected $aes;
    protected $logs;
    public function __construct(){
        $this->aes = new AESCipher;
        $this->logs = new LogsController;
    }

    public function index()
    {

        $users = User::leftjoin('users as u','users.created_by','=','u.id')
                        ->leftjoin('storebranch', 'storebranch.id', '=' ,'users.store')
                        ->select('users.*','storebranch.storename','u.username')
                        ->orderBy('users.role', 'asc')
                        ->get();

        $stores = Storebranch::all();
        $itemtype = Itemtype::where('store',session('store'))->get();


        return view('pages.user-management',compact('users','stores','itemtype'));
    }

    public function add(Request $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $pass1 = $request->pass1;
        $pass2 = $request->pass2;
        $role = $request->role;
        $store = $request->store;
        
        
        if(empty($firstname)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        if(empty($lastname)){
            return response()->json(['Error'=>1, 'message'=>'Empty lastname']);
        }
        if(empty($email)){
            return response()->json(['Error'=>1, 'message'=>'Empty Email']);
        }
        if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email)) {
            return response()->json(['Error' => 1, 'message' => 'Invalid email']);
        }
        if(empty($role)){
            return response()->json(['Error'=>1, 'message'=>'Empty Role']);
        }
        if($role == 2){
            if(empty($store)){
                return response()->json(['Error'=>1, 'message'=>'Empty Branch']);
            }
        }
        if(empty($pass1) || empty($pass2)){
            return response()->json(['Error'=>1, 'message'=>'Empty Password']);
        }
        if($pass1 != $pass2){
            return response()->json(['Error'=>1, 'message'=>'Password is not Match']);
        }
        if(strlen($pass1) < 5 || strlen($pass1) < 5 ){
            return response()->json(['Error'=>1, 'message'=>'Password is too short<br> Minimum of 5 character']);
        }
        
        
        $user = User::where('email','=',$email)->first();

        if(!empty($user)){
            return response()->json(['Error'=>1, 'message'=>'Email Already Exist']);
        }
        $data = [
            'username'=> $firstname,
            'firstname'=> $firstname,
            'lastname'=> $lastname,
            'email'=> $email,
            'password'=> bcrypt($pass1),
            'store'=> $store,
            'created_by'=> session('user_id'),
            'role'=> $role
        ];

        $user = User::create($data);
        
        if($user){
            $this->logs->save(["description"=>"New user ".$firstname." has been added",
                                "store"=>session('store')
                            ]);

            return response()->json(['Error'=> 0,'message'=>'New user added']);
        }
        return response()->json(['Error'=> 1,'message'=>'New user Failed to save']);
    }

    // delete
    public function delete(Request $request){

        $id = $this->aes->decrypt($request->id);
        $name = $request->name;
        $delete = User::where('id',$id)->delete();
        if($delete){
            $this->logs->save(["description"=> "".$name." has been deleted",
                                "store"=>session('store')
                            ]);
                            
            return response()->json(['Error'=>0,'message'=>'User Deleted']);
        }
        return response()->json(['Error'=>1,'message'=>'Deleting Failed']);

    }

    public function edit(Request $request){
        $id = $this->aes->decrypt($request->id);
        $efirstname = $request->efirstname;
        $elastname = $request->elastname;
        $eemail = $request->eemail;
        $erole = $request->erole;
        $estore = $request->estore;
        $epass1 = $request->epass1;
        $epass2 = $request->epass2;

        if(empty($efirstname)){
            return response()->json(['Error'=>1, 'message'=>'Empty Firstname']);
        }
        if(empty($elastname)){
            return response()->json(['Error'=>1, 'message'=>'Empty Lastname']);
        }
        if(empty($eemail)){
            return response()->json(['Error'=>1, 'message'=>'Empty Email']);
        }
        if($erole == 2){
            if(empty($estore)){
                return response()->json(['Error'=>1, 'message'=>'Empty Branch']);
            }
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
            'username'=>$efirstname,
            'firstname'=>$efirstname,
            'lastname'=>$elastname,
            'email'=>$eemail,
            'role'=>$erole,
            'store'=>$estore,
            'password'=>bcrypt($epass1)
        ];
        if(empty($epass1) || empty($epass2)){
            $data = [
                'username'=>$efirstname,
                'firstname'=>$efirstname,
                'lastname'=>$elastname,
                'email'=>$eemail,
                'role'=>$erole,
                'store'=>$estore,
            ];
        }
        

        $update = User::where('id',$id)->update($data);
        if($update){
            $this->logs->save(["description"=> "".$efirstname." has been updated",
                                "store"=>session('store')
                            ]);

            return response()->json(['Error'=>0,'message'=>'Update Successful']);
        }

    }


    public function detail(Request $request){
        $id = $this->aes->decrypt($request->id);
        $eid = $this->aes->encrypt($id);

        $details = User::where('id','=',$id)->first();
        return response()->json([
            'firstname'=>$details->firstname,
            'lastname'=>$details->lastname,
            'email'=>$details->email,
            'role'=>$details->role,
            'store'=>$details->store,
            'eid'=>$eid,
            'id'=>$id
        ]);
    }



}
