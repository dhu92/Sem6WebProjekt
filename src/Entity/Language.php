<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 21.03.18
 * Time: 08:52
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="Language")
 * @ORM\Entity
 */
class Language
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\id
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @ORM\name
     */
    private $name;
}