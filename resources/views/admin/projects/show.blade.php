@extends('layouts.app')

@section('title', $project->title)

@section('content')

    <div>
        <p>{{ $project->technology->label }}</p>
        <p>
            @forelse ($project->types as $type)
                {{ $type->label }} @unless ($loop->last)
                    ,
                @else
                    .
                @endunless
            @empty
                No type found.
            @endforelse
        </p>
        <img src="{{ asset('storage/' . $project->image) }}" alt="Picture" width="400px">
        <p>{{ $project->description }}</p>
        <a href="{{ $project->link }}">{{ $project->link }}</a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Back to Projects</a>
    </div>

@endsection
