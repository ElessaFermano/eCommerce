@extends('dashboard')
@section('content')
<script>
    const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
</script>
<link rel="stylesheet" href="{{ asset('css/useredit.css') }}">
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">EDIT PRODUCT</h3>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description: </label>
        <input type="text" name="description" class="form-control" value="{{ $product->description }}" required>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group">
        <label for="category_id">Category:</label>
        <select name="category_id" class="form-control" id="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="addButton">Update</button>
</form>

@endsection
