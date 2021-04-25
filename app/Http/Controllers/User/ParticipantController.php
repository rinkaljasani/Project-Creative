<?php

namespace App\Http\Controllers\User;

use App\CompetitionFreelancer;
use App\Freelancer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ParticipantController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $participant = new CompetitionFreelancer();
        $participant->competition_id = Crypt::decryptString($request->competition_id);
        $participant->freelancer_id = auth()->user()->freelancer->id;
        $participant->save();
        return redirect()->back()->with('message','Successfully Bid');
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CompetitionFreelancer::where('competition_id', Crypt::decryptString($id))->where('freelancer_id',auth()->user()->freelancer->id)->firstOrFail(['id']);
        $delete->delete();
        return redirect()->back();
    }
}
