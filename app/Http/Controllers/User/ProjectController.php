<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Language;
use App\Project;
use App\ProjectLanguage;
use App\ProjectSkill;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('user.projects.index',compact('projects'));
    }

    public function create()
    {
        $skills = Skill::all(['id','skill']);
        $languages = Language::all(['id','name']);
        return view('user.projects.create',compact('skills','languages'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = auth()->id();
        $project = new Project($request->all());
        $project->save();
        foreach($request['languages'] as $language) 
        {
            ProjectLanguage::create([
                'project_id' => $project->id,
                'language_id' => Crypt::decryptString($language),
            ]);
        }
        foreach($request['skills'] as $skill) 
        {
            ProjectSkill::create([
                'project_id' => $project->id,
                'skill_id' => Crypt::decryptString($skill),
            ]);
        }
        return redirect()->back()->with('message','Successfully Create Project');   
    }

    public function show($id)
    {
        $project = Project::where('id',Crypt::decryptString($id))->with(['languages','user','skills'])->first();
        $languages = Language::all(['id','name']);
        $skills = Skill::all(['id','skill']);
        return view('user.projects.show',compact('project','languages','skills'));
    }

    public function edit($id)
    {
        $project = Project::where('id',Crypt::decryptString($id))->with(['languages','user','skills'])->first();
        $skills = Skill::all(['id','skill']);
        $languages = Language::all(['id','name']);
        return view('user.projects.edit',compact('skills','languages','project'));
    }

    public function update(Request $request, $id)
    {
         $project = Project::where('id',Crypt::decryptString($id))->with(['languages','user','skills'])->first();
         $project->update($request->all());
         return redirect()->back()->with('message','Successfully Update Project');   

    }

    public function destroy($id)
    {
        //
    }
}
