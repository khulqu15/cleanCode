@extends('layouts.frontend')

@section('content')
    <h1>{{ $tool->name }}</h1>
    <p class="mb-0">{{ $tool->location }}</p>
    @if ($tool->status == 1)
        <span class="badge mb-3 badge-success">Active</span>
    @else
        <span class="badge mb-3 badge-danger">Non Active</span>
    @endif
    <div class="alert alert-info" role="alert">
        <strong>{{ $tool->info }}</strong>
    </div>
@endsection
