<?php

namespace App\Http\Controllers;

use App\Project;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        # List projects
        $pager = request('rows', 10);
        $projects = Project::paginate($pager);
        return view('home', ['projects' => $projects]);
    }


    public function form(Request $request)
    {
        # Add or edit project
        if ($request->isMethod('POST')) {
            $project = Project::findOrNew($request->id);
            $project->fill($request->except('country_ids', 'region'));
            $project->save();
            # Save countries (many to many relationship)
            $project->countries()->sync($request->country_ids);
            return redirect("home")->withOk('Saved');
        }

        $project = Project::find(request()->id);
        if ($request->has('delete')) {
            $project->delete();
            return back();
        }

        $load['project'] = $project;
        $load['regions'] = Region::get();
        $load['countries'] = Region::find(\request('region'))->countries ?? [];
        return view('form', $load);
    }
}
