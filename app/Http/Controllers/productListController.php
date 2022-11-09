<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

// 商品情報一覧画面
class productListController extends Controller
{
    public $products;
    // 全件表示
    public function showList() {       
        $model = new Product();
        $products = $model->getList();

        return view('productList', ['products' => $products]);
    }

//  検索
    public function searchList(Request $request) {
        $model = new Product();
        $products = $model->searchList($request);

        return view('productList', [
            'search_product_name' => $request->searchProductName, 
            'search_company_name' => $request->searchCompanyName, 
            'products' => $products, 
        ]);
    }

    // 削除
    public function delete($id) {
        $model = new Product();
        $products = $model->deleteList($id);

        return view('productList',[
            'products' => $products,
            ]);
    }

    // 新規登録画面へ遷移
    public function add() {
        return view('addProduct');
    }

    // 新規登録
    public function added(ProductRequest $request) {

        DB::beginTransaction();
    
        try {
            $model = new Product();
            $products = $model->addList($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        return view('addProduct');
    } 
}


