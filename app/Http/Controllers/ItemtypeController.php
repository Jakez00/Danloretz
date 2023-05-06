<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itemtype;

class ItemtypeController extends Controller
{
    protected $logs;
    protected $aes;
    public function __construct(){
        $this->logs = new LogsController;
        $this->aes = new AESCipher;
    }

    public function index()
    {
        
        $itemtype = Itemtype::leftjoin('users','itemtypes.created_by','=','users.id')
                            ->where('itemtypes.store',session('store'))
                            ->select('itemtypes.*','users.username')
                            ->get();

        return view('pages.itemtype',compact('itemtype'));
    }

    public function add(Request $request)
    {
        $name = $request->name;
        $description = $request->description;

        if(empty($name)){
            return response()->json(['Error'=>1, 'message'=>'Empty Item Name']);
        }
        
        $user = Itemtype::where('itemtypename',$name)
                        ->where('store',session('store'))
                        ->first();

        if(!empty($user)){
            return response()->json(['Error'=>1, 'message'=>'Item Already Exist']);
        }

        $data = [
            'itemtypename'=> $name,
            'description'=> $description,
            'created_by'=> session('user_id'),
            'store'=> session('store')
        ];

        $user = Itemtype::create($data);
        
        if($user){
            $this->logs->save(["description"=>"New Item ".$name." has been added",
                                "store"=>session('store')
                            ]);

            return response()->json(['Error'=> 0,'message'=>'New Item added']);
        }


    }

    public function delete(Request $request){
        $id = $this->aes->decrypt($request->id);
        $name = $request->name;

        $delete = Itemtype::where('id',$id)->delete();

        if($delete){
            $this->logs->save(["description"=>"Item ".$name." has been deleted",
                            ]);

            return response()->json(['Error'=>0,'message'=>'Item '.$name.' Deleted']);
        }
        return response()->json(['Error'=>1,'message'=>'Deleting Failed']);

    }

    public function edit(Request $request){
        
        $id = $this->aes->decrypt($request->id);
        $ename = $request->ename;
        $edescription = $request->edescription;

        if(empty($ename)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        $chckuser = Itemtype::where('itemtypename','=',$ename)
                        ->where('id','!=',$id)
                        ->first();

        if(!empty($chckuser)){
            return response()->json(['Error'=>1,'message'=>'Item Already Exist']);
        }

        $data = [
            'itemtypename'=>$ename,
            'description'=>$edescription,
        ];
        

        $update = Itemtype::where('id',$id)->update($data);
        if($update){
            $this->logs->save(["description"=>"Item ".$ename." updated",
                                "store"=>session('store')
                            ]);
            
            return response()->json(['Error'=>0,'message'=>'Update Successful']);
        }

    }


    public function detail(Request $request){

        $id = $this->aes->decrypt($request->id);
        // dd($id);
        $details = Itemtype::where('id','=',$id)->first();
        return response()->json([
            'name'=>$details->itemtypename,
            'description'=>$details->description,
        ]);
    }
}
