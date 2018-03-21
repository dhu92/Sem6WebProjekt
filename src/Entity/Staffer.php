<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 21.03.18
 * Time: 09:02
 */

namespace App\Entity;

/**
 * @ORM/Entity
 */

class Staffer
{
    /**
     * @ORM/OneToMany(targetEntity="App/Entity/Ticket", mappedBy='')
     */
    private $tickets;

    /**
     * @ORM/ManyToMany(targetEntity="")
     */
    private $categories;
}