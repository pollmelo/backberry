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
 * @property DateTime $created_at
 * @property DateTime $updated_at
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

    /**
     * @var array<string,int> $attributes
     */
    protected $attributes = [
        'phase' => 1,
    ];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
