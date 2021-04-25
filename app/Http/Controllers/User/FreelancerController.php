<?php

namespace App\Http\Controllers\User;

use App\Freelancer;
use App\FreelancerLanguage;
use App\FreelancerSkill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFreelancer;
use App\Language;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FreelancerController extends Controller
{
    public function index()
    {
        $freelancers = Freelancer::with(['languages','skills','user'])->get(['id','user_id','level']);
        $languages = Language::all(['id','name']);
        $skills = Skill::all(['id','skill']);
        return view('user.freelancers.index',compact('freelancers','languages','skills'));
    }

    public function create()
    {
        $languages = Language::all(['id','name']);
        $skills = Skill::all(['id','skill']);
        return view('user.freelancers.create',compact('languages','skills'));
    }

    public function store(StoreFreelancer $request)
    {
        $freelancer = Freelancer::create([
            'user_id' => auth()->id(),
            'level' => $request->level,
        ]);
        foreach($request['languages'] as $language) 
        {
            FreelancerLanguage::create([
                'freelancer_id' => $freelancer->id,
                'language_id' => Crypt::decryptString($language),
            ]);
        }
        foreach($request['skills'] as $skill) 
        {
            FreelancerSkill::create([
                'freelancer_id' => $freelancer->id,
                'skill_id' => Crypt::decryptString($skill),
            ]);
        }
        return redirect()->back()->with('message','Successfully Created Your Freelancer Profile');   
    }

    public function show($id)
    {
        $freelancer = Freelancer::where('id',Crypt::decryptString($id))->with(['languages','user','skills'])->first(['id','user_id','level']);
        $languages = Language::all(['id','name']);
        $skills = Skill::all(['id','skill']);
        return view('user.freelancers.show',compact('freelancer','languages','skills'));
    }
    public function edit($id)
    {
        return view('user.freelancer.edit');
    }

    public function update(Request $request, $id)
    {
        $freelancer = Freelancer::where('id',Crypt::decryptString($id))->first();
        $freelancer->update($request->all());
        return redirect()->back()->with('message','Update Freelancer Profile Successfully');
    }

    public function destroy(Freelancer $freelancer)
    {
        $freelancer->destroy();
        return redirect()->back()->with('message','Successfully delete Your Freelancer Profile');
    }
}
