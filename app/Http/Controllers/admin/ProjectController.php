<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $project = new Project;
        $technologies = Technology::orderBy('label')->get();
        $types = Type::orderBy('label')->get();
        return view('admin.projects.create', compact('project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {

        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image|:jpg,png,jpeg',
                'link' => 'required|url',
                'technology_id' => 'nullable|exists:technologies,id',
                'types' => 'nullable|exists:types,id'
            ],
            [
                'title.required' => 'Title is mandatory!',
                'title.string' => 'Title must be a string!',
                'description.rquired' => 'Description is mandatory!',
                'description.string' => 'Description must be a string!',
                'image.image' => 'Insert a valid image!',
                'image.mimes' => 'Accepted extensions are jpg,png,jpeg!',
                'link.required' => 'Link is mandatory!',
                'link.url' => 'Insert a valid Url!',
                'technology_id.exists' => 'This technology is not valid!',
                'types.exists' => 'Invalid tags selected!'
            ]
        );

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            $path = Storage::put('uploads/projects', $data['image']);
            $data['image'] = $path;
        }

        $project = new Project;
        $project->fill($data);
        $project->slug = Str::of($project->title)->slug('-');

        $project->save();

        if (Arr::exists($data, "types")) $project->types()->attach($data["types"]);

        return to_route('admin.projects.show', $project)->with('message', 'Project added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::orderBy('label')->get();
        $types = Type::orderBy('label')->get();
        $projects_types = $project->types->pluck('id')->toArray();
        return view('admin.projects.create', compact('project', 'technologies', 'types', 'projects_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|url',
                'link' => 'required|url',
                'technology_id' => 'nullable|exists:technologies,id'
            ],
            [
                'title.required' => 'Title is mandatory!',
                'title.string' => 'Title must be a string!',
                'description.rquired' => 'Description is mandatory!',
                'description.string' => 'Description must be a string!',
                'image.url' => 'Insert a valid Url!',
                'link.required' => 'Link is mandatory!',
                'link.url' => 'Insert a valid Url!',
                'technology_id.exists' => 'This technology is not valid!'

            ]
        );

        $data = $request->all();


        $project->fill($request->all());
        $project->slug = Str::of($project->title)->slug('-');

        $project->update($data);
        if (Arr::exists($data, "types")) $project->types()->sync($data["types"]);
        else
            $project->types()->detach();


        return to_route('admin.projects.show', $project)->with('message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted!');
    }
}
