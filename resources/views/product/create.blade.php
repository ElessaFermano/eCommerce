@extends('dashboard')
@section('content')
<div class="container">
    <h2>ADD NEW PRODUCT</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description"></textarea>

        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price">

        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" id="image">
    
        </div>

        <div class="form-group">
            <label for="category_id"> Category </label>
            <select name="category_id" class="form-control" id="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
    
        </div>

        <button type="submit" class="addProduct">Add Product</button>
    </form>
</div>
@endsection