<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class productListController extends Controller
{
    public $products;
    // 全件表示
    public function showList () {       
        $model = new Product();
        $products = $model -> getList();

        return view('show_product', ['products' => $products]);
    }

    // 検索
    public function searchList (Request $request) {

        $model = new Product();
        $products = $model -> searchList($request);

        return view('show_product', [
            'search_product_name' => $request -> searchProductName, 
            'search_company_name' => $request -> searchCompanyName, 
            'products' => $products
        ]);
    }

    // 削除
    public function delete ($id) {
        $model = new Product();
        $products = $model -> deleteList($id);

        return view('show_product', ['products' => $products,]);
    }

    // 新規登録画面へ遷移
    public function add () {
        return view('add_product');
    }

    // 新規登録
    public function added (ProductRequest $request) {

        DB::beginTransaction();
    
        try {
            $model = new Product();
            $products = $model -> addList($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        return redirect('/productlist/add') -> with('message', '商品を追加しました');
    } 

    // 商品詳細画面
    public function more ($id) {
        
        $model = new Product();
        $product = $model -> moreList($id);
        
        return view('more_product', ['product' => $product]);
    }

    // 商品情報編集画面
    public function edit ($id) {

        $model = new Product();
        $product = $model -> moreList($id);
        
        return view('edit_product', ['product' => $product]);
    }

    // 更新
    public function update (ProductRequest $request) {

        DB::beginTransaction();
    
        try {
            $model = new Product();
            $product = $model -> updateList($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return view('edit_product', ['product' => $product]);
    }
}


