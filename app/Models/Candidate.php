<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_name',
        'party_id',
        'constituency_id',
        'vote_count'
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }

    public function constituency()
    {
        return $this->belongsTo(Constituency::class, 'constituency_id');
    }

    // increment vote count
    public function incrementVoteCount()
    {
        $this->vote_count++;
        $this->save();
    }
}
