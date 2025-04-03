@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cart Items</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>${{ $cart->product->price }}</td>
                <td>${{ $cart->quantity * $cart->product->price }}</td>
                <td>
                    <form action="{{ route('admin.cart.destroy', $cart->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Remove this item from cart?')">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $carts->links() }}
</div>
@endsection
