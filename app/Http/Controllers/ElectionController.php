<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreElectionRequest;
use App\Http\Requests\UpdateElectionRequest;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'election_id' => 'required',
        ]);

        if($validated->fails()){
            flash()->addError('Election cannot be started!');
            return redirect()->back();
        }
        if(Election::where('is_started', true)->count() == 0){
            $election = Election::create([
                'is_started' => true,
            ]);
            flash()->addSuccess('Election started!');
            return redirect()->back();
        }
        else{
            $election = Election::find($request->election_id);
            $election->is_started = false;
            $election->save();
            flash()->addSuccess('Election ended!');
            return redirect()->back();
        }
    }
}
