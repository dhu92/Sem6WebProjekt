<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;


/**
 * Created by PhpStorm.
 * User: bauer
 * Date: 11.04.2018
 * Time: 10:05
 */
class CacheKernel extends HttpCache{

    protected function getOptions(){
        return array('default_ttl1' => 0);
    }

}