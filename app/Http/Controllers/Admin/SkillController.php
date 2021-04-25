<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.skills.index',compact('skills'));

    }

    public function create()
    {
         return view('admin.skills.create');
    }

    public function store(Request $request)
    {

        $skill = new Skill;
        $skill['skill'] = $request['name'];
        $skill['discription'] = $request['description']; 
         if(request()->hasFile('image')){
            $Image = $request['image'];
            $ImageName = str_random() . time() . '.' . $Image->getClientOriginalExtension();
            request()->file('image')->storeAs('images/skills/',$ImageName);
        }
        $skill->image = $ImageName;
        $skill->save();
        return redirect()->back()->with('message', 'skill Add successfully');
    }

    public function show(Skill $skill)
    {
       // return view('admin.skills.show',compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill = Skill::where('id',$skill->id)->first();
        if(request()->hasFile('image')){
            $image = request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('images/skills/', $image);
            $skill['image'] = $image;   
        }

        $skill['image'] = $skill->image;
        $skill['skill'] = $request['name'];
        $skill['discription'] =$request['discription'];
        $skill->save();
        
        return redirect()->back()->with('message', 'skill Update successfully');
    }
    
    public function destroy(Skill $skill)
    {
        $skill->delete($skill);
        return redirect()->back()->with('message', 'skill deleted successfully');
    }
}
