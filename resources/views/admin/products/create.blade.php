@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Images:</label>
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
