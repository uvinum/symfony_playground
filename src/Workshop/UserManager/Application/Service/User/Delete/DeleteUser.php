<?php

namespace UserManager\Application\Service\User\Delete;

use UserManager\Application\Service\Core\ApplicationService;
use UserManager\Domain\Infrastructure\Event\DomainEventRecorder;
use UserManager\Domain\Infrastructure\Event\User\UserDeleted;
use UserManager\Domain\Infrastructure\Repository\User\UserRepository;
use UserManager\Domain\Model\User\UserId;

final class DeleteUser implements ApplicationService
{
    /** @var UserRepository */
    private $user_repository;

    public function __construct(UserRepository $a_user_repository)
    {
        $this->user_repository = $a_user_repository;
    }

    public function __invoke(DeleteUserRequest $a_request)
    {
        $user_id = new UserId($a_request->userId());

        $this->user_repository->delete($user_id);

        DomainEventRecorder::instance()->recordEvent(new UserDeleted($user_id->userId()));
    }
}