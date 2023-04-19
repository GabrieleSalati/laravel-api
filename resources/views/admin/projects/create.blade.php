@extends('layouts.app')

@section('actions')
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Back to Projects</a>
@endsection

@section('content')
    <div>
        <form action="POST" action="{{ route('admin.projects.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="email" class="form-control" id="title" name="title" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="email" class="form-control" id="link" name="link" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Choose image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
        </form>
    </div>
@endsection
