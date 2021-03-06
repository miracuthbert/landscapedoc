<?php
/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 11/11/2017
 * Time: 4:12 PM
 */

namespace App\Observers;


use App\Models\Role;

class RoleObserver
{
    /**
     * Listen to Role creating event.
     *
     * @param Role $role
     */
    public function creating(Role $role)
    {
        //generate role slug
        $role->slug = str_slug($role->name);
    }
}