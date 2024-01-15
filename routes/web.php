<?php

use App\Http\Controllers\ElectionController;
use App\Http\Controllers\HomeController;
use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/vote', [HomeController::class, 'vote'])->name('vote');
Route::group(
    [
        'as' => 'election_commission_officer.',
        'prefix' => 'election_commission_officer',
    ],
    function () {
        Route::post('elections/update', [ElectionController::class, 'update'])->name('elections.update');
        Route::post('announcement', [HomeController::class, 'announcement'])->name('announcement');
    }
);

Route::get('/gevs/constituency/{constituenc_name}', function ($constituencyName) {
    // Find the constituency by its name
    $constituency = Constituency::where('constituency_name', $constituencyName)->first();

    if (!$constituency) {
        return response()->json(['error' => 'Constituency not found'], 404);
    }

    // Get candidates, their party, and vote count for the constituency
    $candidates = Candidate::where('constituency_id', $constituency->id)
        ->with('party')
        ->get()
        ->map(function ($candidate) {
            return [
                'name' => $candidate->candidate,
                'party' => $candidate->party->party_name,
                'vote' => $candidate->vote_count
            ];
        });

    // Prepare the JSON response
    $result = [
        'constituency' => $constituency->constituency_name,
        'result' => $candidates
    ];

    return response()->json($result);
});

Route::get('/gevs/results', function () {
    // Calculate the total number of seats
    $totalSeats = Constituency::count();

    // Count seats for each party
    $partySeats = Candidate::selectRaw('party_id, count(*) as seat')
        ->groupBy('party_id')
        ->get()
        ->mapWithKeys(function ($item) {
            $partyName = Party::find($item->party_id)->party_name;
            return [$partyName => $item->seat];
        });

    // Determine the winning party
    $majoritySeats = ceil($totalSeats / 2);
    $winningParty = '';
    $status = 'Completed';

    foreach ($partySeats as $party => $seats) {
        if ($seats >= $majoritySeats) {
            $winningParty = $party;
            break;
        }
    }

    if (empty($winningParty)) {
        $status = 'Hung Parliament';
        $winningParty = 'No clear winner';
    }

    // Add parties with zero seats
    $allParties = Party::all()->pluck('party_name');
    foreach ($allParties as $party) {
        if (!isset($partySeats[$party])) {
            $partySeats[$party] = 0;
        }
    }

    // Prepare the seats data
    $seatsData = [];
    foreach ($partySeats as $party => $seat) {
        $seatsData[] = ['party' => $party, 'seat' => $seat];
    }

    // Prepare the JSON response
    $result = [
        'status' => $status,
        'winner' => $winningParty,
        'seats' => $seatsData
    ];

    return response()->json($result);
});
