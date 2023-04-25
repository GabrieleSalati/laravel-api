@extends('layouts.app')

@section('title', 'Projects')

@section('actions')
    <div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            Add new project
        </a>
    </div>
@endsection

@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Technology</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>
                        @if ($project->technology)
                            {{ $project->technology->label }}
                        @else
                            No technology
                        @endif
                    </td>
                    {{-- <td>
                        @forelse($project->types as $type)
                        {{ $type->label }}, @empty -
                        @endforelse
                    </td> --}}
                    <td><img src="{{ asset('storage/' . $project->image) }}" alt="Picture" width="200px"></td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}"><i class="bi bi-hand-index"></i></a>
                        <a href="{{ route('admin.projects.edit', $project) }}"><i class="bi bi-pencil"></i></a>
                        <button class="bi bi-trash3 text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-project-modal-{{ $project->id }}"></button>
                    </td>
                </tr>
        </tbody>
        @endforeach
    </table>

@endsection

@section('modals')
    @foreach ($projects as $project)
        <div class="modal fade" id="delete-project-modal-{{ $project->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="#delete-project-modal-{{ $project->id }}">{{ $project->title }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to delete this project?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
