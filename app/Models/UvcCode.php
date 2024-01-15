<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UvcCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'uvc',
        'is_used',
    ];

    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }

    public function scopeUsed($query)
    {
        return $query->where('is_used', true);
    }

    public function voters()
    {
        $this->hasMany(User::class, 'uv_code_id');
    }
}
