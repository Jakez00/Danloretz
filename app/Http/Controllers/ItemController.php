<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Itemtype;

class ItemController extends Controller
{
    protected $logs;
    protected $aes;
    public function __construct(){
        $this->logs = new LogsController;
        $this->aes = new AESCipher;
    }

    public function index(Request $request)
    {
        $itemID = $this->aes->decrypt($request->itemtype);
        $itemname = $request->itemname;
        $itemtype = Itemtype::where('store',session('store'))->get();
        
        $item = Item::leftjoin('users','items.created_by','users.id')
                    ->where('item_type',$itemID)
                    ->select('items.*','users.username')
                    ->get();

        return view('pages.item',[
            'itemname'=>$itemname,
            'itemID'=>$itemID,
        ],compact('item','itemtype'));
    }

    public function add(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $price = str_replace(array('₱ ',','),'',$request->price);
        $quantity = $request->quantity;
        $itemID = $this->aes->decrypt($request->itemID);
// dd($price);
        if(empty($name)){
            return response()->json(['Error'=>1, 'message'=>'Empty Item Name']);
        }
        if(empty($price)){
            return response()->json(['Error'=>1, 'message'=>'Empty price']);
        }
        if(empty($quantity)){
            return response()->json(['Error'=>1, 'message'=>'Empty quantity']);
        }
        
        $user = Itemtype::where('itemtypename',$name)
                        ->where('store',session('store'))
                        ->first();

        if(!empty($user)){
            return response()->json(['Error'=>1, 'message'=>'Item Already Exist']);
        }

        $data = [
            'item_name'=> $name,
            'item_type'=> $itemID,
            'description'=> $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'created_by'=> session('user_id'),
            'item_store'=> session('store')
        ];

        $user = Item::create($data);
        
        if($user){
            $this->logs->save(["description"=>"New Item ".$name." has been added",
                                "store"=>session('store')
                            ]);

            return response()->json(['Error'=> 0,'message'=>'New Item added']);
        }


    }

    public function delete(Request $request){
        $id = $this->aes->decrypt($request->id);

        $delete = Item::where('id',$id)->delete();

        if($delete){
            $this->logs->save(["description"=>"Item has been deleted",
                                "store"=>session('store')]);

            return response()->json(['Error'=>0,'message'=>'Item Deleted']);
        }
        return response()->json(['Error'=>1,'message'=>'Deleting Failed']);

    }

    public function edit(Request $request){
        
        $id = $this->aes->decrypt($request->id);
        $ename = $request->ename;
        $edescription = $request->edescription;
        $eprice = str_replace(array('₱ ',','),'',$request->eprice);
        $equantity = $request->equantity;
        
        if(empty($ename)){
            return response()->json(['Error'=>1, 'message'=>'Empty Name']);
        }
        $chckuser = Item::where('item_name','=',$ename)
                        ->where('id','!=',$id)
                        ->first();

        if(!empty($chckuser)){
            return response()->json(['Error'=>1,'message'=>'Item Already Exist']);
        }

        $data = [
            'item_name'=>$ename,
            'description'=>$edescription,
            'price'=>$eprice,
            'quantity'=>$equantity,
        ];
        

        $update = Item::where('id',$id)->update($data);
        if($update){
            $this->logs->save(["description"=>"Item ".$ename." updated",
                                "store"=>session('store')
                            ]);
            
            return response()->json(['Error'=>0,'message'=>'Update Successful']);
        }

    }
    public function addstock(Request $request){
        
        $id = $this->aes->decrypt($request->id);
        $quantity = $request->stockquantity;
        $name = $request->stockname;

        if(empty($quantity)){
            return response()->json(['Error'=>1, 'message'=>'Empty Stock']);
        }
       
        $update = Item::where('id',$id)->increment('quantity',$quantity);
        if($update){
            $this->logs->save(["description"=>$name." has new ".$quantity." stock/s",
                                "store"=>session('store')
                            ]);
            
            return response()->json(['Error'=>0,'message'=>'Add stock Successful']);
        }

    }


    public function detail(Request $request){

        $id = $this->aes->decrypt($request->id);
        // dd($id);
        $details = Item::where('id','=',$id)->first();
        return response()->json([
            'name'=>$details->item_name,
            'description'=>$details->description,
            'price'=>$details->price,
            'quantity'=>$details->quantity,
        ]);
    }
}
