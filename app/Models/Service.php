<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes, OrderableTrait, PivotOrderableTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get live service(s).
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsLive($query)
    {
        return $query->where('usable', true);
    }

    /**
     * Get service(s) not live.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotLive($query)
    {
        return $query->where('usable', false);
    }

    /**
     * Get services in given category.
     *
     * @param $query
     * @param Category $category
     * @return mixed
     */
    public function scopeFromCategory($query, Category $category)
    {
        return $query->whereIn('category_id', array_merge(
            [$category->id],
            $category->descendants->pluck('id')->toArray()
        ));
    }

    /**
     * Get service status.
     *
     * @return mixed
     */
    public function live()
    {
        return $this->usable;
    }

    /**
     * Get the category that owns the service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The areas that belong to the service.
     */
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'service_areas')->withTimestamps()
            ->withPivot(['usable']);
    }

    /**
     * Get all of the service prices.
     */
    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }

    /**
     * Get all of the service prices.
     */
    public function price()
    {
        $price = $this->prices()->where('usable', true)->first();
        return $price != null ? $price->price : 0.00;
    }

    /**
     * Get all of the service bookings.
     */
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
