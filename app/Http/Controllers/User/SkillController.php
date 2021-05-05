<?php

namespace App\Http\Controllers\User;

use App\FreelancerSkill;
use App\Http\Controllers\Controller;
use App\Language;
use App\ProjectSkill;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        return view('user.skills.index',compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function skillFreelancer($id)
    {
        $languages = Language::all(['id','name']);
        $skills = Skill::all(['id','skill']);
        $freelancer_skills = FreelancerSkill::where('skill_id',$id)->get();
        return view('user.skills.freelancer',compact('freelancer_skills','languages','skills'));

    }
    public function skillProject($id)
    {
        
        $project_skills = ProjectSkill::where('skill_id',$id)->get();
        return view('user.skills.project',compact('project_skills'));        
    }
}
