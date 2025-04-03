@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label>Existing Images:</label><br>
            @foreach ($product->images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" width="50" height="50">
            @endforeach
        </div>
        <div class="form-group">
            <label>New Images:</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
