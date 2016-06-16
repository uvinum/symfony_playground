<?php

namespace Obokaman\Domain\Model\User\Event;

use Obokaman\Domain\Kernel\DomainEvent;

final class UserNameChanged extends DomainEvent
{
    const EVENT_KEY = 'obokaman.user.changed.name';

    /** @var string */
    private $user_id;

    public function __construct($a_user_id)
    {
        parent::__construct();
        $this->user_id = $a_user_id;
    }

    public function userId()
    {
        return $this->user_id;
    }
}