@extends('layouts.app')

@section('title', 'Section')

@section('content')

    <table class="table w-25 mx-auto text-center">
        <thead>
            <tr class="bg-info">
                <th class="col-2">ID</th>
                <th class="col-5">NAME</th>
                <th class="col-5"></th>
            </tr>
        </thead>
        @forelse ($sections as $section)
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