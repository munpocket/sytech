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
        -> orderBy('product_id', 'asc')
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

        if ($request -> searchLowerPrice && $request -> searchLowerPrice !== 0) {
            $products = $products
            -> where('price', '>=', $request -> searchLowerPrice);
        }

        if ($request -> searchUpperPrice && $request -> searchUpperPrice !== 0) {
            $products = $products
            -> where('price', '<=', $request -> searchUpperPrice);
        }

        if ($request -> searchLowerStock && $request -> searchLowerStock !== 0) {
            $products = $products
            -> where('stock', '>=', $request -> searchLowerStock);
        }

        if ($request -> searchUpperStock && $request -> searchUpperStock !== 0) {
            $products = $products
            -> where('stock', '<=', $request -> searchUpperStock);
        }

        $products = $products 
        -> leftjoin('companies','companies.id','=','products.company_id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> get();

        return $products;
    }


    // ソート
    public function sortList ($request) {
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

        if ($request -> searchLowerPrice && $request -> searchLowerPrice !== 0) {
            $products = $products
            -> where('price', '>=', $request -> searchLowerPrice);
        }

        if ($request -> searchUpperPrice && $request -> searchUpperPrice !== 0) {
            $products = $products
            -> where('price', '<=', $request -> searchUpperPrice);
        }

        if ($request -> searchLowerStock && $request -> searchLowerStock !== 0) {
            $products = $products
            -> where('stock', '>=', $request -> searchLowerStock);
        }

        if ($request -> searchUpperStock && $request -> searchUpperStock !== 0) {
            $products = $products
            -> where('stock', '<=', $request -> searchUpperStock);
        }

        $products = $products 
        -> leftjoin('companies','companies.id','=','products.company_id')
        -> select('products.*', 'products.id as product_id', 'companies.company_name')
        -> orderBy($request -> hidC, $request -> hidA)
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

    // 購入
    public function sale ($request) {
        
        $data = \DB::table('products')
        -> where('id', $request -> id)
        -> decrement('stock');

        $product = \DB::table('products')
        -> where('id', $request -> id)
        -> get();

        return $product; 
        
    }
}
