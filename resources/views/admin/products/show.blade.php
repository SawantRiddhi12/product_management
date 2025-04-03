@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Details</h2>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Images:</strong></p>
    @foreach ($product->images as $image)
        <img src="{{ asset('storage/' . $image->image_path) }}" width="100" height="100">
    @endforeach
    <br><br>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
