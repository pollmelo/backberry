<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'end_date',
        'phase',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
