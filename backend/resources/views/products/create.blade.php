@extends('layouts.app')

@section('title', 'New Product')

@section('content')
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
<div class="container w-25">
    <h3>New Product</h3>
    <div class="mb-3">
        <label for="name" class="form-label text-muted">Name</label>
        <input type="text" name="name" id="name" class="form-control" autofocus>
        {{-- Error --}}
        @error('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label text-muted">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        {{-- Error --}}
        @error('image')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
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
        <input type="number" name="price" id="price" class="form-control" aria-describedby="basic-addon1">
    </div>
        {{-- Error --}}
        @error('price')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="section-id" class="form-label small fw-bold">Section</label>
        <select name="section_id" id="section-id" class="form-select">
            <option value="" hidden>Select Section</option>
            @foreach ($all_sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
        </select>
        @if ($all_sections->isEmpty())
            <a href="{{ route('section') }}" class="small text-decoration-none">Add a new section</a>
        @endif
        @error('section_id')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <a href="{{ url('/product') }}" type="submit" class="btn btn-success px-5">Cancel</a>
    <button type="submit" class="btn btn-success px-5">+Add</button>
    </div>
    </form>
@endsection