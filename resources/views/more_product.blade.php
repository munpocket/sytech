@extends('layouts.app')

@section('content')
<table class="product_list">
    
    <thead>
        <tr>
            <th>ID</th>
            <th>IMG</th>
            <th>NAME</th>
            <th>COMPANYNAME</th>
            <th>PRICE</th>
            <th>STOCK</th>
            <th>COMMENT</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $product -> product_id }}</td>
            <td><img src="{{ asset('img/'.$product -> img_path) }}"></td>
            <td>{{ $product -> product_name }}</td>
            <td>{{ $product -> company_name }}</td>
            <td>{{ $product -> price }}</td>
            <td>{{ $product -> stock }}</td>
            <td>{{ $product -> comment }}</td>
            <td><button type="button" class="btn btn-edit"><a href="{{ route('edit', $product -> product_id) }}">{{ __('edit') }}</a></button><td>
            <td><button type="button" class="btn btn-return"><a href="{{ route('list') }}">{{ __('return') }}</a></button><td>
        </tr>      
    </tbody>
</table>
@endsection
