@extends('layouts.app')

@section('content')

<div class="search_form">
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="searchProductName" value="@if(isset($search_product_name)) {{ $search_product_name }} @endif" class="search_product_name" placeholder="product name">
        <select name="searchCompanyName" value="@if(isset($search_company_name)) {{ $search_company_name }} @endif" class="search_company_name">
            <option value="null">未選択</option>
            <option value="3">A社</option>
            <option value="1">B社</option>
            <option value="2">C社</option>
        </select>
        <button class="btn btn-search" type="submit">{{ __('search') }}</button>
    </form>
</div>

<!-- route -->
<div class="add_product">
    <button class="btn btn-add" type="button">
        <a href="{{ route('add') }}">{{ __('add item') }}</a>
    </button>

</div>

<table class="product_list">
    <thead>
        <tr>
            <th>ID</th>
            <th>IMG-PATH</th>
            <th>NAME</th>
            <th>PRICE</th>
            <th>STOCK</th>
            <th>COMPANY</th>
        </tr>
    </thead>

    <tbody>
    
    @foreach ($products as $products)
    <!-- @if(empty($products))
    <p>empty</p>
    @break
    @endif -->
        <tr>
            <td>{{ $products -> product_id }}</td>
            <td>{{ $products -> img_path }}</td>
            <td>{{ $products -> product_name }}</td>
            <td>{{ $products -> price }}</td>
            <td>{{ $products -> stock }}</td>
            <td>{{ $products -> company_name }}</td>
    
            <td><button type="button" class="btn btn-more"><a href="#">{{ __('more') }}</a></button></td>
            <td><a href="{{ route('delete', $products->product_id) }}"><input type="button" value="削除" onclick='return confirm("削除しますか？");'></a></td>
            
        </tr>      
    
    @endforeach
    </tbody>
</table>

@endsection