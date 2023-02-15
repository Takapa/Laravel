@extends('layouts.app')

@section('title', 'Product')

@section('content')    
<div class="w-75 mx-auto">
    <div class="row mb-3">
        <div class="col">
            <h2 class="">Products</h2>
        </div>
    </div>
    
    <table class="table table-hover align-middle bg-white border">
        <thead class="small table-success text-secondary">
            <tr>
                <th>ID</th>
                <th style="width: 100px">NAME</th>
                <th style="width: 80px">IMAGE</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>SECTION</th>
                <th style="width: 105px;"></th>
            </tr>
        </thead>

        <tbody>

        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td class="fw-bold">{{ $product->name }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->image }}" class="img-thumbnail w-100" style="width:50px; height:50px;">
                    @else
                        <i class="fa-solid fa-image fa-10x d-block text-center"></i>
                    @endif
                </td>
                <td class="text-truncate" style="max-width: 150px;">{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->section ? $product->section->name : 'Uncategorized' }}</td>
                <td>
                <div class="d-flex">
                    <a href="{{ route('product.edit', $product->id)}}" class="btn btn-primary btn-sm mx-1"><i class="fa-solid fa-pen"></i>Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-product-{{ $product->id }}"><i class="fa-solid fa-trash-can"></i></button>
                </div>                  
                </td>
            </tr> 
            @include('products.modal.delete')  
        @empty
            <tr>
                <td colspan="6">
                    <div class="lead text-center">No item to display.</div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection