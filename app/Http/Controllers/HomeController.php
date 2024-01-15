<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_election_commission_officer){
            $election = Election::where('is_started', true)->first();

            return view('election_commission_officer.home', compact('election'));
        }
        else{
            $election = Election::where('is_started', true)->first();
            $candidates = Candidate::with('constituency', 'party')->get();

            return view('home', compact('election', 'candidates'));
        }
    }

    public function vote(Request $request){
        $validated = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        if($validated->fails()){
            flash()->addError('Candidate cannot be voted!');
            return redirect()->back();
        }

        $candidate = Candidate::find($request->candidate_id);
        $candidate->incrementVoteCount();
        $user = Auth::user();
        $user->constituency_id = Candidate::find($request->candidate_id)->constituency_id;
        $user->save();

        flash()->addSuccess('Voted successfully!');
        return redirect()->back();
    }
}
