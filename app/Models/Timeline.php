<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    /**
     * Get all of the owning timeable models.
     */
    public function timeable()
    {
        return $this->morphTo();
    }
}
