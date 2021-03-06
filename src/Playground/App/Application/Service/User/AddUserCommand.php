<?php

namespace Playground\App\Application\Service\User;

use Playground\App\Domain\Model\User\Email;
use Playground\App\Domain\Model\User\UserId;

final class AddUserCommand
{
    /** @var string */
    private $user_id;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var array */
    private $skills;

    public function __construct($a_name, $an_email, array $some_skills)
    {
        $this->user_id = (string) UserId::generateUniqueId();
        $this->name    = $a_name;
        $this->email   = $an_email;
        $this->skills  = $some_skills;
    }

    public function userId()
    {
        return new UserId($this->user_id);
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return new Email($this->email);
    }

    public function skills()
    {
        return $this->skills;
    }
}
