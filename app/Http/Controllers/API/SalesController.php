<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesRequest;
use App\Models\Sales;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function sales (SalesRequest $request) {

        DB::beginTransaction();
    
        try {
            // 在庫が0以外ならsalesテーブルにレコード＆stock減らす

            $data =\DB::table('products')
            -> where('id', $request -> id)
            -> value('stock');
            
            if ($data > 0) {
                $model1 = new Sales();
                $sales = $model1 -> sale($request);
                $model2 = new Product();
                $products = $model2 -> sale($request);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        return response()->json(['products' => $products, 'sale' => $sales]);
    } 

}
