<?php
/**
 * Copyright (c) 2017. All Right Reserved.
 */

/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 11/13/2017
 * Time: 4:21 PM
 */

namespace App\Observers;


use App\Models\Service;

class ServiceObserver
{

    /**
     * Listen to Service creating event.
     *
     * @param Service $service
     */
    public function creating(Service $service)
    {
        //generate role slug
        $service->slug = str_slug($service->name);
    }
}