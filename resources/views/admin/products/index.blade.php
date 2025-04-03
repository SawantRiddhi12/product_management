@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product List</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ $product->price }}</td>
                <td>
                    @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" width="50" height="50">
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
