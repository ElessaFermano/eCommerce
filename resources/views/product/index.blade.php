@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{asset('css/user.css')}}">
<div class="container">
    <h1>Products List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                        @endif
                    </td>
                    <td>{{ $product->stock }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
