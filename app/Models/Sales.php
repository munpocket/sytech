<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// 商品情報
class Sales extends Model
{
        
    public function sale ($request) {
        $data = \DB::table('sales')
        -> insert([
            'product_id' => $request -> id
        ]);

        $sales = \DB::table('sales')
        -> get();
        
        return $sales;
    }
}
