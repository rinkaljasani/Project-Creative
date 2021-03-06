<?php

namespace App\Http\Controllers\User;

use App\CompetitionData;
use App\CompetitionFreelancer;
use App\Freelancer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Project;
use App\ProjectCompetition;
use App\Skill;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Query\insert;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Image;

class CompetitionController extends Controller
{
    public function index(
)    {
        if(auth()->user()->freelancer != null)
        {
            $competitions = ProjectCompetition::with(['project','participants'])
                        ->where('user_id', '!=' ,auth()->id())
                        ->where('registration_last_date','>=', date('Y-m-d'))
                        ->with(['project'])
                        ->get();    
        }
        else
        {
            return redirect()->route('user.freelancers.create')->with('message','First Make Freelancer Profile');
        }
        return view('user.competitions.index',compact('competitions'));
    }

    public function create($id)
    {
        $project = Project::where('id',Crypt::decryptString($id))->with(['competitions'])->first();
        return view('user.competitions.create',compact('project'));
    }

    public function store(Request $request)
    {
        
        $project = Project::findOrFail(Crypt::decryptString($request->project_id));
        $date = $project->created_at;
        $daysToAdd = $project->total_days;
        $date = $date->addDays($daysToAdd);
        $request->validate([
          'name' => 'required|min:5|unique:project_competitions',
            'registration_last_date' => 'required|date|after_or_equal:today',
            'model_submission_last_date' => 'required|date|after_or_equal:registration_last_date|before:'.$date,
            'data_type' => 'required',
        ]);
        // dd($date);
        $competition = ProjectCompetition::firstOrNew([
            'user_id' => auth()->id(),
            'project_id'  => Crypt::decryptString($request->project_id),
            'name' => $request->name,   
            'data_type' => $request->data_type,
            'registration_last_date' => $request->registration_last_date, 
            'model_submission_last_date' => $request->model_submission_last_date,
        ]);

       $competition->save();
        return redirect()->back()->with('message','Competition Created Successfully');
    }

    public function show($id)
    {
        $status = '';
        $competition = ProjectCompetition::where('id',Crypt::decryptString($id))->with(['project','participants'])->first();
        $freelancer = Freelancer::where('user_id', auth()->id())->first();
        if($freelancer == null){
            $participant = CompetitionFreelancer::where('competition_id',$competition->id)->first(['id','isAssinged']);
        }
        else{
            $participant = CompetitionFreelancer::where('competition_id',$competition->id)->where('freelancer_id',$freelancer->id)->first(['id','isAssinged']);
        }
        if($participant)
            $status='bid';
        return view('user.competitions.show',compact('competition','status','id'));

    }

    public function destroy(ProjectCompetition $competition)
    {
        $competition->delete();
        return redirect()->back()->with('message','Competition successfully Deleted');
    }
    public function sampledata($id)
    {
        if(auth()->user()->freelancer->id != null )
            $participant = CompetitionFreelancer::where('competition_id',Crypt::decryptString($id))->where('freelancer_id',auth()->user()->freelancer->id)->firstOrFail();
        return view('user.competitions.sampledata',compact('participant'));
    }
    public function sampledataStore(Request $request)
    {
        $ImageName = '';
        if(request()->hasFile('data')){
            $Image = $request['data'];
            $ImageName = str_random() . time() . '.' . $Image->getClientOriginalExtension();
            request()->file('data')->storeAs('images/data/',$ImageName);
        }
        $comp = CompetitionData::where('bid_id',$request['bid_id'])->where('freelancer_id',auth()->user()->freelancer->id)->get();
    
        if($comp->count() >= 1)
        {
            $model = CompetitionData::where('freelancer_id',auth()->user()->freelancer->id)->orderBy('updated_at')->first();     
            $model->data = $ImageName;
            $model->save();
        }
        else
        {
            $model = CompetitionData::firstOrCreate([
                'bid_id' => $request['bid_id'],
                'data' => $ImageName,
                'freelancer_id' => auth()->user()->freelancer->id
            ]);    
        }
        
        $competitions = CompetitionData::where('bid_id',$request['bid_id'])->orderBy('created_at','DESC')->get();
        return view('user.users.participant-data',compact('competitions'));

    }
    public function getAllCompetitionFreelancer($id)
    {
        $skills = Skill::get();
        $competition_freelancers = CompetitionFreelancer::where('competition_id',$id)->orderBy('freelancer_id','DESC')->get();
        return view('user.competitions.freelancer',compact('competition_freelancers','skills'));
    }

    public function getSingleFreelancerData($id)
    {
         $competitions = CompetitionData::where('bid_id',$id)->orderBy('created_at','DESC')->get();
        return view('user.users.participant-data',compact('competitions'));
    }

    public function singleDataShow($id)
    {
        $bid_data = CompetitionData::where('id',$id)->firstOrFail();
        return view('user.competitions.singledata',compact('bid_data'));
    }

    public function dataApproved(Request $request)
    {
        $bid = CompetitionData::where('id',$request->bid_id)->first();
        $bid->isApproved = '1';
        $bid->save();
        return redirect()->back();
    }
    public function projectAssigned(Request $request)
    {
        $bid = CompetitionFreelancer::where('id',$request->bid_id)->first();
        $project = $bid->competition->project;
        $project->isAssinged = '1';
        $project->save();
        $bid->isAssinged = $bid->freelancer_id;
        $bid->save();
        return redirect()->back();
    }
}
    