<?php
/**
 * Created by PhpStorm.
 * User: danielmadurell
 * Date: 8/9/16
 * Time: 16:45
 */

namespace Workshop\UserBundle\Controller;

use Symfony\Component\EventDispatcher\Event;

class UserAdded extends Event
{
    /**
     * UserAdded constructor.
     */
    public function __construct()
    {
    }
}