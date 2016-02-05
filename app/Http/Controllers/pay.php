<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class pay extends Controller
{   public function pay(Request $request){
        
        $obj = new \stdclass();
        
        if($request->isMethod('post')) {
          $params = $request->input('params');
          $id_token = $params["id_token"];
          $query = DB::select('select tipo from token WHERE id="'.$id_token.'"');
          if(count($query)>0){
            foreach($query as $item){
              $obj->success = "true";
              $obj->tipo = $item->tipo;
            }
          } else {
            $obj->success = "false";
            $obj->text = "ningún usuario encontrado";
          }
        } else {
          $obj->success = "false";
          $obj->text = "intento de hack se le informará a los administradores";
        }
        return json_encode($obj);
    }
    //
}
