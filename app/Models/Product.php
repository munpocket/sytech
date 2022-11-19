<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// 商品情報
class Product extends Model
{
    public $products;

    // 取得、結合
    public function getList () {
        $products = \DB::table('products') 
        -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }

    // 検索
    public function searchList ($request) {
        
        $products = \DB::table('products');
        // 商品名が入っている場合
        if ($request -> searchProductName) {
            $products = $products
            -> where('product_name', 'like', '%'.$request -> searchProductName.'%');
        }
        // 会社名が入っている場合
        if ($request -> searchCompanyName && $request -> searchCompanyName !== 0) {
            
            $products = $products
            -> where('company_id', $request -> searchCompanyName);
        }

        $products = $products 
        -> leftjoin('companies','companies.id','=','products.company_id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }
    
    // 削除
    public function deleteList ($id) {
        $data = \DB::table('products')
        -> where('id', $id)
        -> delete();
        
        $products = \DB::table('products') 
        -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }

    // 追加
    public function addList ($request) {
        $data = \DB::table('products')
        -> insert([
            'product_name' => $request -> productName,
            'company_id' => $request -> companyName,
            'price' => $request -> price,
            'stock' => $request -> stock,
            'comment' => $request -> comment,
            'img_path' => $request -> img_path
           ]);
    }

    // 詳細画面
    public function moreList ($id) {
        $product = \DB::table('products')
        -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        $product = $product
        -> where('product_id', $id)
        -> first();
        
        return $product;
    }

    // 編集
    public function updateList ($request) {
        $data = \DB::table('products')
        -> where('id', $request -> id)
        -> update([
            'product_name' => $request -> productName,
            'company_id' => $request -> companyName,
            'price' => $request -> price,
            'stock' => $request -> stock,
            'comment' => $request -> comment,
            'img_path' => $request -> img_path
        ]);

        $product = \DB::table('products')
        -> leftjoin('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        $product = $product
        -> where('product_id', $request->id)
        -> first();

        return $product;
    }
}
