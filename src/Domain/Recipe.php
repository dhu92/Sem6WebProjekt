<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/14/2018
 * Time: 10:09 AM
 */

namespace App\Domain;


class Recipe {

    public $name;

    public function setName($newname) {
        $this->name = $newname;
    }
}