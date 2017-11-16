<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    /**
     * Get all of the owning bookable models.
     */
    public function bookable()
    {
        return $this->morphTo();
    }

    /**
     * Get area that owns the booking.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get user that owns the booking.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking budget.
     */
    public function budget()
    {
        return $this->morphOne(Budget::class, 'budgetable');
    }

    /**
     * Get the booking expected budget.
     */
    public function expBudget()
    {
        return $this->budget != null ? $this->budget->expected_budget : 0.00;
    }

    /**
     * Get the booking timeline.
     */
    public function timeline()
    {
        return $this->morphOne(Timeline::class, 'timeable');
    }

    /**
     * Get the booking expected start.
     */
    public function expStart()
    {
        return $this->timeline != null ? $this->timeline->starts_at : null;
    }

    /**
     * Get the booking expected start date.
     */
    public function expStartDate()
    {
        return $this->expStart() != null ? $this->expStart()->toDateString() : null;
    }

    /**
     * Get the booking expected end.
     */
    public function expEnd()
    {
        return $this->timeline != null ? $this->timeline->ends_at : null;
    }

    /**
     * Get the booking expected end date.
     */
    public function expEndDate()
    {
        return $this->expEnd() != null ? $this->expEnd()->toDateString() : null;
    }
}
