<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property DateTime $end_date
 * @property int $phase
 */
class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'end_date',
        'phase',
    ];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
