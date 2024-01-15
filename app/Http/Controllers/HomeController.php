<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Election;
use App\Models\Party;
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
        if (Auth::user()->is_election_commission_officer) {
            $election = Election::where('is_started', true)->first();
            $candidates = Candidate::with('constituency', 'party')->get();

            return view('election_commission_officer.home', compact('election', 'candidates'));
        } else {
            $election = Election::where('is_started', true)->first();
            $candidates = Candidate::with('constituency', 'party')->get();

            return view('home', compact('election', 'candidates'));
        }
    }

    public function vote(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        if ($validated->fails()) {
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

    public function announcement(Request $request)
    {
        // Step 1: Calculate the total number of seats
        $totalSeats = Constituency::count();

        // Step 2: Count votes for each party
        $partySeats = Candidate::selectRaw('party_id, count(*) as seats_won')
            ->groupBy('party_id')
            ->orderByDesc('seats_won')
            ->get();

        // Step 3: Determine Majority
        $majoritySeats = ceil($totalSeats / 2);
        $winningParty = $partySeats->first();

        if ($winningParty && $winningParty->seats_won > $majoritySeats) {
            // Majority is achieved
            $partyName = Party::find($winningParty->party_id)->party_name;
            flash("The winner of the election is " . $partyName . " with a majority of " . $winningParty->seats_won . " seats.");
        } else {
            // Hung Parliament
            flash("This election has resulted in a Hung Parliament.");
        }
        return redirect()->back();
    }
}
