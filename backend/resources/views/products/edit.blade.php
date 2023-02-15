@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

<div class="container w-25">
    <h3>Edit Product</h3>
    <div class="mb-3">
        <label for="name" class="form-label text-muted">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" autofocus>
        {{-- Error --}}
        @error('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label text-muted">Image</label>
        <img src="{{ asset('/storage/images/' . $product->image) }}" alt="{{ $product->image }}" class="w-100 img-thumbnail">
        <input type="file" name="image" id="image" class="form-control" value="{{ old('image', $product->image) }}">
        {{-- Error --}}
        @error('image')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
        {{-- Error --}}
        @error('description')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">$</span>
        </div>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}"  aria-describedby="basic-addon1">
    </div>
        {{-- Error --}}
        @error('price')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="section_id" class="form-label">Section</label>
            <select name="section_id" id="section_id" class="form-control form-select">
                <option value="" hidden>Select Section</option>
                @foreach ( $all_sections as $section )
                    @if ($section->id == $product->section_id)
                        <option value="{{ $section->id }}" selected>{{ $section->name }}</option>
                    @else
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endif
                @endforeach  
            </select>
        {{-- Error --}}
        @error('section_id')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <a href="{{ url('/product') }}" type="submit" class="btn btn-secondary px-5">Cancel</a>
    <button type="submit" class="btn btn-secondary px-5">Save changes</button>
    </div>
    </form>
@endsection


