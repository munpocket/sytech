@extends('layouts.app')

@section('content')

<form action="{{ route('update', $product -> product_id) }}" method="post">
    @csrf
        
    <!-- idは固定表示だが値送信に使うため、input=hidden -->
    <!-- tableタグに入れるとform送信できない -->
    <input type="hidden" name="id" value="{{ $product -> product_id }}">{{ $product -> product_id }}   

    <input type="text" name="productName" value="{{ $product -> product_name }}">
    @if ($errors -> has('productName'))
    <p>{{ $errors -> first('productName') }}</p>
    @endif
    
    <select name="companyName">
        <option value="{{ $product -> company_id }}" selected="selected">{{ $product -> company_name }}</option>
        <option value="3">A社</option>
        <option value="1">B社</option>
        <option value="2">C社</option>
    </select>
    @if ($errors -> has('companyName'))
    <p>{{ $errors -> first('companyName') }}</p>
    @endif

    <input type="text" name="price" value="{{ $product -> price }}">
    @if ($errors -> has('price'))
    <p>{{ $errors -> first('price') }}</p>
    @endif

    <input type="text" name="stock" value="{{ $product -> stock }}">
    @if($errors -> has('stock'))
    <p>{{ $errors -> first('stock') }}</p>
    @endif

    <textarea name="comment" value="{{ $product -> comment }}" cols="30" rows="10">{{ $product -> comment }}</textarea>

    <input name="img_path" type="file" value="{{ $product -> img_path }}">

    <input type="submit" class="btn btn_update" value="update" onclick='return confirm("更新しますか？")'>
    <button type="button" class="btn btn_return"><a href="{{ route('more', $product -> product_id) }}">{{ __('return') }}</a></button>
</form>

@if (session('message'))
    <div class="alert alert_danger">
        {{ session('message') }}
    </div>
@endif

@endsection
