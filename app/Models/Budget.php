<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    /**
     * Get all of the owning budgetable models.
     */
    public function bookable()
    {
        return $this->morphTo();
    }

    /**
     * Get the payment category that owns the budget.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
