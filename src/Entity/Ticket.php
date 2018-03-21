<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 21.03.18
 * Time: 08:52
 */

namespace App\Entity;

/**
 * @ORM/Entity
 */

class Ticket
{
    /**
     * @ORM/Column(type="integer")
     * @ORM/GeneratedValue
     * @ORM/id
     */
    private $id;
    /**
     * @ORM/Column(type="text")
     */
    private $message;

    /**
     * @ORM/ManyToOne(targetEntity="App/Entity/Staffer" inversedBy="tickets")
     */
    private $staffer;
}