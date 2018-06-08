<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 6/8/2018
 * Time: 11:05 AM
 */

namespace App\Exception;


class RecipeNotFoundException extends \Exception {

    public $message = "The recipe you are looking for does not exist!";

}