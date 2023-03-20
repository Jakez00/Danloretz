<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storebranch;
use App\Http\Controllers\LogsController;

class StorebranchController extends Controller
{   
    protected $logs;
    public function __construct(){
        $this->logs = new LogsController;
    }

    public function index()
    {

        $stores = Storebranch::leftjoin('users','storebranch.created_by','=','users.id')
                    ->select('storebranch.*','users.username')
                    ->orderBy('storebranch.storename', 'ASC')->get();


        return view('pages.storebranch',compact('stores'));
    }

    public function add(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $location = $request->location;

        if(empty($name)){
            return response()->json(['Error'=>1, 'message'=>'Empty Store Name']);
        }
        if(empty($location)){
            return response()->json(['Error'=>1, 'message'=>'Empty Location']);
        }
        
        $user = Storebranch::where('storename','=',$name)->first();

        if(!empty($user)){
            return response()->json(['Error'=>1, 'message'=>'Store Already Exist']);
        }

        $data = [
            'storename'=> $name,
            'description'=> $description,
            'created_by'=> session('user_id'),
            'location'=> $location
        ];

        $user = Storebranch::create($data);
        
        if($user){
            $this->logs->save(["description"=>"New Branch ".$name." has been added",
                                "store"=>session('store')
                            ]);

            return response()->json(['Error'=> 0,'message'=>'New Store added']);
        }


    }

    public function delete(Request $request){
        $id = $request->id;
        $name = $request->name;

        $delete = Storebranch::where('id',$id)->delete();

        if($delete){
            $this->logs->save(["description"=>"Branch ".$name." has been deleted",
                            ]);

            return response()->json(['Error'=>0,'message'=>'Branch '.$name.' Deleted']);
        }
        return response()->json(['Error'=>1,'message'=>'Deleting Failed']);

    }

    public function edit(Request $request){
        
        $id = $request->id;
        $ename = $request->ename;
        $edescription = $request->edescription;
        $elocation = $request->elocation;

        if(empty($ename)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        if(empty($elocation)){
            return response()->json(['Error'=>1, 'message'=>'Empty Email']);
        }
        $chckuser = Storebranch::where('storename','=',$ename)
                        ->where('id','!=',$id)
                        ->first();

        if(!empty($chckuser)){
            return response()->json(['Error'=>1,'message'=>'Store Already Exist']);
        }

        $data = [
            'storename'=>$ename,
            'description'=>$edescription,
            'location'=>$elocation,
        ];
        

        $update = Storebranch::where('id',$id)->update($data);
        if($update){
            $this->logs->save(["description"=>"Branch ".$ename." updated",
                                "store"=>session('store')
                            ]);
            
            return response()->json(['Error'=>0,'message'=>'Update Successful']);
        }

    }


    public function detail(Request $request){
        $id = $request->id;

        $details = Storebranch::where('id','=',$id)->first();
        return response()->json([
            'name'=>$details->storename,
            'description'=>$details->description,
            'location'=>$details->location
        ]);
    }
}
