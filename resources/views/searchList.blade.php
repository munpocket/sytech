@extends('layouts.app')

@section('content')

<div class="search_form">
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="searchProductName" value="{{ $search_product_name }}" class="search_product_name" placeholder="product name">
        <select name="searchCompanyName" value="{{ $search_company_name }}" class="search_company_name">
            <option value="null">未選択</option>
            @foreach($products as $product)
            <option value="companyName">{{ $product -> company_name }}</option>
            @endforeach
        </select>
        <button class="btn btn-search" type="submit">{{ __('search') }}</button>
    </form>
</div>

<!-- route -->
<div class="add_product">
    <button class="btn btn-add" type="button">
        <a href="#">{{ __('add item') }}</a>
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
    @foreach ($search_products as $product)
        <tr>
            <td>{{ $product -> id }}</td>
            <td>{{ $product -> img_path }}</td>
            <td>{{ $product -> product_name }}</td>
            <td>{{ $product -> price }}</td>
            <td>{{ $product -> stock }}</td>
            <td>{{ $product -> company_name }}</td>
    
            <td><button type="button" class="btn btn-more"><a href="#">{{  __('more') }}</a></button></td>
            <td><button type="button" class="btn btn-remove">{{ __('remove') }}</button></td>
        </tr> 
        
      
    @endforeach
    
    </tbody>
</table>

@endsection