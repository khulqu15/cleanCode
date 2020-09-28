@extends('layouts.frontend')

@section('content')
    <a href="{{ route('tools.create') }}" class="btn btn-white border-success mb-3">Create new</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Location</th>
                <th>Status</th>
                <th>Settings</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tools as $tl)
            <tr>
                <td scope="row">{{ $tl->name }}</td>
                <td>{{ $tl->location }}</td>
                <td>{{ $tl->status }}</td>
                <td>
                    <form action="{{ route('tools.destroy', $tl->id) }}" method="POST">
                        <a href="{{ route('tools.show', $tl->id) }}" class="btn btn-white border-primary">Detail</a>
                        <a href="{{ route('tools.edit', $tl->id) }}" class="btn btn-white border-primary">Edit</a>
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-white border-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
