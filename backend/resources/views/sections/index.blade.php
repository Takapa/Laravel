@extends('layouts.app')

@section('title', 'Section')

@section('content')
<div>
    <form action="{{ route('section.store') }}" method="post">
    @csrf
    <div class="row mx-auto w-25 mb-3">
        <input type="text" name="name" class="col-9">
        <button type="submit" class="btn btn-primary btn-sm col-3">+Add</button>
  
    {{-- Error --}}
    @error('section')
        <p class="text-danger">Error</p>
    @enderror
    </div>
    </form>
</div>

<div >
    <form action="{{ route('section.search') }}" method="get">
        <div class="row mx-auto w-25 mb-3">
        <input type="search" name="search" class="col-9" placeholder="Search...">
        <button type="submit" class="btn btn-success btn-sm col-3">Search</button>
        </div>
    </form>
</div>

    <table class="table w-25 mx-auto text-center">
        <thead>
            <tr class="bg-info">
                <th class="col-2">ID</th>
                <th class="col-5">NAME</th>
                <th class="col-5"></th>
            </tr>
        </thead>
        @forelse ($all_sections as $section)
        <tbody class="">
            <tr>
                <td>{{ $section->id }}</td>
                <td>{{ $section->name }}</td>

                <td>
                    <form action="{{ route('section.destroy', $section->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6">
                    <div class="lead text-center">No Section.</div>
                </td>
            </tr> 
        @endforelse
    </tbody>

    </table>

        
@endsection