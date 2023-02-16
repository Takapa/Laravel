@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="mt-2 w-50 mx-auto">
        @if ($user->avatar)
            <a href="" class="text-decoration-none btn border position-relative" style="width: 6.5rem; height: 6.5rem; border-radius: 50%;">
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="text-start position-absolute top-0 end-0" style="width: 6.5rem; height: 6.5rem; border-radius: 50%;"></a>
        @else
            <a style="width: 6.5rem; height: 6.5rem; border-radius: 50%;"><i class="fa-solid fa-user-pen fa-xl"></i></a>
        @endif
            <a href="{{ route('profile.edit') }}">Edit Page</a>
</div>       
<div class="mt-2 w-50 mx-auto">
    <label for="name" class="form-label fs-3">Name: {{ $user->name }}</label>
    <br>
    <label for="email" class="form-label fs-3">Email: {{ $user->email }}</label>
    <br>
    <label for="products" class="form-label fs-3">Products:</label>
</div>
    @foreach ( $user->products as $product )
    <div class="col-3 mx-2 mx-auto w-50">
        @if ($product->image)
            <a href="{{ route('product.edit', $product->id) }}"><img src="{{ asset('/storage/images/' . $product->image) }}" alt="{{ $product->image }}" class="" style="width: 200px; height: 300px; float:left;"></a>
        @else
            <a href="{{ route('product.edit', $product->id) }}"><img src="{{ asset('/storage/noimages/download-1.png') }}" style="width: 200px; height: 300px;  float:left"></a>
        @endif
    </div>
    @endforeach


@endsection

