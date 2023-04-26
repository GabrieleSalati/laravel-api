@extends('layouts.app')

@section('title', $project->title)

@section('actions')
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Back to Projects</a>
@endsection

@section('content')
    @include('layouts.partials.errors')
    <div>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="technology_id" class="form-label">Technology</label>
                <select name="technology_id" id="technology_id" class="form-select" aria-label="Default select example">
                    <option selected>Select tech</option>
                    @foreach ($technologies as $technology)
                        <option @if (old('techonology_id', $project->technology_id) == $technology->id)  @endif value="{{ old('technology', $technology->id) }}">
                            {{ $technology->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="types" class="form-label">Type</label>
                @foreach ($types as $type)
                    <input class="form-check-control" type="checkbox" name="types[]" id="types - {{ $type->id }}"
                        value="{{ $type->id }}"><label for="types"
                        class="form-label">{{ old('types', $type->label) }}</label>
                @endforeach
                @error('types')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                    value="{{ old('link', $project->link) }}">
                @error('link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Choose image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
        </form>
    </div>
@endsection
