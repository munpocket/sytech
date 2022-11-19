@extends('layouts.app')

@section('content')
<!-- 新規登録 -->
<form action="{{ route('added') }}" method="post">
    @csrf

    <input name="productName" type="text" placeholder="商品名">
    @if ($errors -> has('productName'))
    <p>{{ $errors -> first('productName') }}</p>
    @endif

    <select name="companyName" placeholder="会社名">
        <option value="3">A社</option>
        <option value="1">B社</option>
        <option value="2">C社</option>
    </select>
    @if ($errors -> has('companyName'))
    <p>{{ $errors -> first('companyName') }}</p>
    @endif
    
    <input name="price" type="text" placeholder="価格">
    @if ($errors -> has('price'))
    <p>{{ $errors -> first('price') }}</p>
    @endif
    
    <input name="stock" type="text" placeholder="在庫">
    @if ($errors -> has('stock'))
    <p>{{ $errors -> first('stock') }}</p>
    @endif
    
    <textarea name="comment" value="null" cols="30" rows="10" placeholder="コメント"></textarea>
    
    <input name="img_path" value="null" type="file" placeholder="画像">
    
    <button type="submit" value="登録"></button>
</form>

<a href="{{ route('list') }}" class="btn">戻る</a>

@if (session('message'))
    <div class="alert alert_danger">
        {{ session('message') }}
    </div>
@endif
@endsection
