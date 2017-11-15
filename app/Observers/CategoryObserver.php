<?php
/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 11/11/2017
 * Time: 4:23 PM
 */

namespace App\Observers;


use App\Models\Category;

class CategoryObserver
{

    /**
     * Listen to the Category creating event.
     *
     * @param Category $category
     */
    public function creating(Category $category)
    {
        //generate slug
        $prefix = $category->parent ? $category->parent->name . ' ' : '';
        $category->slug = str_slug($prefix . $category->name);

        //make children category usable
        $category->status = $category->status == null ? $category->parent ? true : false : $category->status;
    }
}