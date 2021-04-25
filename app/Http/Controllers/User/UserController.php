<?php

namespace App\Http\Controllers\User;

use App\CompetitionFreelancer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $isFreelancer = auth()->user()->freelancer;
        $participants = '';
        if($isFreelancer != null)
        {
            $participants = CompetitionFreelancer::where('freelancer_id',auth()->user()->freelancer->id)->get();
        }
        else{
            $participants = '';
        }
        return view('user.users.profile',compact('participants'));
    }
    public function myParticipartData()
    {
        
    }
}
