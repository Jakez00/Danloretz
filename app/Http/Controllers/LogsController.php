<?php

namespace App\Http\Controllers;

use App\Models\Logs;

class LogsController extends Controller
{
  public function index(){
    return "Invalid Action";

  }
  public function save($data = []){
      $log = new Logs();
      $log->user_id = session('user_id');
      $log->description = $data["description"];
      // $log->table_name = $data["table_name"];
      // $log->ip_address = request()->ip();
      // $log->row_id = $data["row_id"];
      if($log->save()){
        return true;
      }
      return false;

}

}
