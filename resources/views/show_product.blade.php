@extends('layouts.app')

@section('content')

<div class="search_form">
    <!-- <form action="{{ route('search') }}" method="post"> -->
@csrf
        <input type="text" name="searchProductName" value="@if(isset($search_product_name)) {{ $search_product_name }} @endif" class="search_product_name" placeholder="product name" id="searchProductName">
        <select name="searchCompanyName" value="@if(isset($search_company_name)) {{ $search_company_name }} @endif" class="search_company_name" id="searchCompanyName">
            <option value="0">未選択</option>
            <option value="3">A社</option>
            <option value="1">B社</option>
            <option value="2">C社</option>
        </select>
        <input type="text" name="searchLowerPrice" id="searchLowerPrice" placeholder="価格下限">～<input type="text" name="searchUpperPrice" id="searchUpperPrice" placeholder="価格上限">
        <input type="text" name="searchLowerStock" id="searchLowerStock" placeholder="在庫下限">～<input type="text" name="searchUpperStock" id="searchUpperStock" placeholder="在庫上限">
        <input class="btn" id="btn_search" type="button" value="{{ __('search') }}">
            <!-- </form> -->
        <!-- <button class="btn" id="btn_search" type="button"><a href="{{ route('search') }}">{{ __('search') }}</a></button> -->
</div>

<div class="add_product">
    <button class="btn btn_add" type="button">
        <a href="{{ route('add') }}">{{ __('add item') }}</a>
    </button>

</div>

<table class="product_list">
    <thead>
        <tr>
            @csrf
            <th><input type="button" class="col_sort" id="id" value="product_id"></input></th>
            <th><input type="button" class="col_sort" id="imgPath" value=""></input></th>
            <th><input type="button" class="col_sort" id="name" value="product_name"></input></th>
            <th><input type="button" class="col_sort" id="price" value="price"></input></th>
            <th><input type="button" class="col_sort" id="stock" value="stock"></input></th>
            <th><input type="button" class="col_sort" id="company" value="company_name"></input></th>
            <input type="hidden" id="hidA"> <!-- asc or desc（初期値”　”）※クリックするごとにi++となり、iが偶数が奇数かで値を与える -->
            <input type="hidden" value="product_id" id="hidC"> <!-- ソートするカラム名（初期値ID）-->
        </tr>
    </thead>

    <tbody id="product_list_items">
    <!-- foreachは配列が空なら実行されない -->
    @foreach ($products as $products)
        <tr>
            <td>{{ $products -> product_id }}</td>
            <td>{{ $products -> img_path }}</td>
            <td>{{ $products -> product_name }}</td>
            <td>{{ $products -> price }}</td>
            <td>{{ $products -> stock }}</td>
            <td>{{ $products -> company_name }}</td>
    
            <td><button type="button" id="btn_more"><a href="{{ route('more', $products -> product_id) }}">{{ __('more') }}</a></button></td>
            <td><button type="button" value="{{ $products -> product_id }}" class="btn_delete">削除</button></td>
            <!-- inputだとvalueが表示されてしまう -->
            <!-- できないときはcache削除 -->
            <!-- <a href="{{ route('delete', $products -> product_id) }}"></a> -->
            <!-- <input type="hidden" value="{{ $products -> product_id }}"> -->
            
        </tr>      
    @endforeach
    </tbody>
</table>

@endsection
