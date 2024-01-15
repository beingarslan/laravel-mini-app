<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = [
        'constituency_name',
    ];

    public function voters()
    {
        $this->hasMany(User::class, 'constituency_id');
    }
}
