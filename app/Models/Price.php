<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    /**
     * Get all of the owning priceable models.
     */
    public function priceable()
    {
        return $this->morphTo();
    }
}
