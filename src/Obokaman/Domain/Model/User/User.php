<?php

namespace Obokaman\Domain\Model\User;

use Obokaman\Domain\Kernel\EventStore;
use Obokaman\Domain\Model\User\Event\UserCreated;
use Obokaman\Domain\Model\User\Event\UserEmailChanged;
use Obokaman\Domain\Model\User\Event\UserNameChanged;

class User
{
    /** @var UserId */
    private $user_id;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    public function __construct(UserId $a_user_id, $a_name, Email $an_email)
    {
        $this->user_id = $a_user_id;
        $this->name    = $a_name;
        $this->email   = $an_email;
    }

    public static function create($a_name, Email $an_email)
    {
        $user_id = UserId::generateUniqueId();
        $user    = new self($user_id, $a_name, $an_email);

        EventStore::instance()->storeEvent(new UserCreated((string) $user_id));

        return $user;
    }

    public function userId()
    {
        return $this->user_id;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function changeName($a_name)
    {
        if ($this->name == $a_name)
        {
            return;
        }

        EventStore::instance()->storeEvent(new UserNameChanged((string) $this->user_id));

        $this->name = $a_name;
    }

    public function changeEmail(Email $an_email)
    {
        if ($this->email->equals($an_email))
        {
            return;
        }
        
        EventStore::instance()->storeEvent(new UserEmailChanged((string) $this->user_id));
        
        $this->email = $an_email;
    }
}