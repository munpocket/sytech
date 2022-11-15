@extends('layouts.app')

@section('content')
<table class="product_list">
    
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>COMPANYNAME</th>
            <th>PRICE</th>
            <th>STOCK</th>
            <th>COMMENT</th>
            <th>IMG</th>
        </tr>
    </thead>
    
    <tbody>
        <form action="{{ route('update', $product->id) }}" method="post">
            @csrf
            <tr>
                <!-- idは固定表示だが値送信に使うため、input=hidden -->
                <td><input type="hidden" name="id" value="{{ $product -> product_id }}" />{{ $product -> product_id }}</td>    
                <td><input type="text" name="productName" value="{{ $product -> product_name }}">
                @if($errors->has('productName'))
                <p>{{ $errors->first('productName') }}</p>
                @endif</td>
                
                <td><select name="companyName" value="{{ $product -> company_name }}">
                    <option value="null">未選択</option>
                    <option value="3">A社</option>
                    <option value="1">B社</option>
                    <option value="2">C社</option>
                </select>
                @if($errors->has('companyName'))
                <p>{{ $errors->first('companyName') }}</p>
                @endif</td>

                <td><input type="text" name="price" value="{{ $product -> price }}">
                @if($errors->has('price'))
                <p>{{ $errors->first('price') }}</p>
                @endif</td>

                <td><input type="text" name="stock" value="{{ $product -> stock }}">
                @if($errors->has('stock'))
                <p>{{ $errors->first('stock') }}</p>
                @endif</td>

                <td><textarea name="comment" value="{{ $product -> comment }}" cols="30" rows="10">{{ $product -> comment }}</textarea></td>
                <td><input name="img_path" type="file" value="{{ $product -> img_path }}"></td>
            
            </tr>
            <button type="submit" class="btn btn-update" onclick='return confirm("更新しますか？");'>{{ __('update') }}</button>
            <button type="button" class="btn btn-return"><a href="{{ route('more', $product->product_id) }}">{{ __('return') }}</a></button>
        </form>     
    </tbody>
</table>
@if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif
@endsection