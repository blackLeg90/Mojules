<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Layout;
use App\Models\Home;

class ProjectController extends Controller
{
  public function index ()
  {

      return Project::with('layouts.homes')->get();
  }

  public function view ()
  {
//    $project = Project::with('layouts.homes')->where('id', $id)->get()->pop();
      $project = Project::with('layouts.homes')->get();
//    \Debugbar::info($project);

//    return view('project-view', [
//      'project' => $project->toJson()
//    ]);
      return $project;
  }

  public function create (Request $request)
  {
    return view('project-form', [
      'project' => NULL
    ]);
  }

  public function update (Request $request, $id)
  {
    $project = Project::findOrFail($id);
    return view('project-form', [
      'project' => $project
    ]);
  }

  public function store (Request $request, $id = NULL)
  {
    $input = $request->all();
    \Debugbar::info($input);

    // validation: project
    $validationRules = [
      'projectName' => 'required'
    ];

    $validationResults = $request->validate($validationRules);

    // project
    if ($id === NULL) $projectModel = new Project;
    else $projectModel = Project::findOrFail($id);
    $projectModel->projectName = $input['projectName'];
    $projectModel->save();

    // layout
    if (array_key_exists('layouts', $input)) {
      foreach ($input['layouts'] as $layout) {
        if (!array_key_exists('id', $layout)) $layoutModel = new Layout;
        else $layoutModel = Layout::findOrFail($layout['id']);
        if (array_key_exists('fileName', $layout)) $layoutModel->fileName = $layout['fileName'];
        $layoutModel->project_id = $projectModel->id;
        $layoutModel->save();
      }
    }

    return response()->json(['projectId' => $projectModel->id]);
  }

  public function delete ($id)
  {
    $project = Project::with('layouts')->where('id', $id)->get()->pop();
    foreach($project->layouts as $layout) {
        if ($layout->fileName) Storage::disk(env('FILE_DRIVER'))->delete($layout->fileName);
    }

    Project::destroy($id);

    return redirect('/projects');
  }
}
