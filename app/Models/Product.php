<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// 商品情報
class Product extends Model
{
    public function getList() {
        $products = DB::table('products') -> join('companies', 'products.company_id', '=', 'companies.id')
                                          -> select('products.*', 'companies.company_name')
                                          -> get();

        return $products;
    }
    
}


