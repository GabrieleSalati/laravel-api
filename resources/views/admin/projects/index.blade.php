@extends('layouts.app')

@section('title', 'Projects')

@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->image }}</td>
                    <td><a href="{{ route('admin.projects.show', $project) }}"><i class="bi bi-hand-index"></i></a></td>
                </tr>
        </tbody>
        @endforeach
    </table>

@endsection
