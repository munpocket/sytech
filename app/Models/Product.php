<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// 商品情報
class Product extends Model
{
    public $products;

    // 取得、結合
    public function getList() {
        $products = \DB::table('products') 
        -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }

    // 検索
    public function searchList($request) {
        //2つとも入っている場合　→isset,is_nullはあってもいいけどなくてもよい
        if($request->searchProductName && $request->searchCompanyName) {
            $products = \DB::table('products')
            ->where('product_name', 'like', '%'.$request->searchProductName.'%')
            ->where('company_id', $request->searchCompanyName);
        }

        // 商品名のみ入っている場合
        elseif($request->searchProductName && !$request->searchCompanyName) {
            $products = \DB::table('products')
            ->where('product_name', 'like', '%'.$request->searchProductName.'%');
        }

        // 会社名のみ入っている場合
        elseif(!$request->searchProductName && $request->searchCompanyName) {
            $products = \DB::table('products')
            ->where('company_id', $request->searchCompanyName);
        }

        $products = $products -> leftjoin('companies','companies.id','=','products.company_id')
                              -> select('products.*', 'products.id as product_id', 'companies.company_name')
                              -> get();

        return $products;
    }
    
    // 削除
    public function deleteList($id) {
        $data = \DB::table('products')
        ->where('id', $id)
        ->delete();
        
        $products = \DB::table('products') -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }

    // 追加
    public function addList($request) {
        $data = \DB::table('products')
        -> insert([
            'product_name' => $request->productName,
            'company_id' => $request->companyName,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
           ]);

        
    }
}


