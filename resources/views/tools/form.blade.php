@extends('layouts.frontend')

@section('content')
    @if (\Route::current()->getName() == 'tools.edit')
        <h1>Edit Tools</h1>
        <form action="{{ route('tools.update', $tool) }}" method="POST">
        {!! method_field('PUT') !!}
    @else
        <h1>Create Tools</h1>
        <form action="{{ route('tools.store') }}" method="POST">
    @endif
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input  value="{{ \Route::current()->getName() == 'tools.edit' ? $tool->name : '' }}"
                    type="text" name="name" id="name" class="form-control" placeholder="Tool's Name" aria-describedby="nameId">
            <small id="nameId" class="text-muted"></small>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input  value="{{ \Route::current()->getName() == 'tools.edit' ? $tool->location : '' }}"
                    type="text" name="location" id="location" class="form-control" placeholder="Tool's location" aria-describedby="locationId">
            <small id="locationId" class="text-muted"></small>
        </div>
        <div class="form-group">
            <input  value="{{ \Route::current()->getName() == 'tools.edit' ? $tool->status : '0' }}"
                    type="number" name="status" id="status" class="form-control" placeholder="0" aria-describedby="locationId">
        </div>
        <div class="form-group">
            <label for="info">Info</label>
            <input  value="{{ \Route::current()->getName() == 'tools.edit' ? $tool->info : '' }}"
                    type="text" name="info" id="info" class="form-control" placeholder="Tool's Info" aria-describedby="infoId">
            <small id="infoId" class="text-muted"></small>
        </div>
        <button type="submit" class="btn btn-primary px-5">Submit</button>
    </form>

@endsection
