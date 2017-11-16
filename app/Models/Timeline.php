<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    protected $dates = [
        'starts_at',
        'ends_at',
        'started_at',
        'completed_at',
    ];

    /**
     * Get all of the owning timeable models.
     */
    public function timeable()
    {
        return $this->morphTo();
    }
}
