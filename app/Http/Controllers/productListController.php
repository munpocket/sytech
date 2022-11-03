<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

// 商品情報一覧画面
class productListController extends Controller
{
    // 全件表示
    public function showList() {
        $model = new Product();
        $products = $model->getList();

        return view('productList', ['products' => $products]);
    }

//  showListメソッド実行後
    public function search(Request $request) {
        $model = new Product();
        $products = $model->getList();
        $search_product_name = $request->input('searchProductName');
        $search_company_name = $request->input('searchCompanyName');

        $search_products=Product::query();

        if(isset($search_product_name) && isset($search_company_name)) {
            $search_products->where('product_name', 'like', "%{ $search_product_name }%")
                            ->where('company_name', $search_company_name);
        }

        elseif(isset($search_product_name) && is_null($search_company_name)) {
            $search_products->where('product_name', 'like', "%{ $search_product_name }%");
        }

        elseif(is_null($search_product_name) && isset($search_company_name)) {
            $search_products->where('company_name', $search_company_name);
        }


        return view('searchList', [
            'search_product_name' => $search_product_name, 
            'search_company_name' => $search_company_name, 
            'products' => $products, 
            'search_products' => $search_products
        ]
        );
    }

}


