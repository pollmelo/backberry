<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $poll_id
 * @property int $description
 */
class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'description',
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}
