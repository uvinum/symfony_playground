<?php

namespace Workshop\CacheBundle\src\Domain\Infrastructure\Repository;

use Workshop\CacheBundle\src\Domain\Infrastructure\Cache\Cache;
use Workshop\UserBundle\src\Domain\Model\User\User;
use Workshop\UserBundle\src\Domain\Model\User\ValueObject\UserId;
use Workshop\UserBundle\src\Domain\Repository\User\UserRepository;

class UserCacheRepository implements UserRepository
{
    private $user_repository;

    private $cache_service;

    public function __construct(UserRepository $a_user_repository, Cache $a_cache_service)
    {
        $this->user_repository = $a_user_repository;
        $this->cache_service = $a_cache_service;
    }

    public function findAll()
    {
        $cache_key = 'user_repository_findAll';
        $content = $this->cache_service->get($cache_key);
        
        if (false === $content)
        {
            $content = $this->user_repository->findAll();
            $this->cache_service->set($cache_key, $content);
        }

        return $content;
    }

    public function findById(UserId $user_id)
    {
        $cache_key = 'user_repository_findById_' . $user_id->userId();
        $content = $this->cache_service->get($cache_key);

        if (false === $content)
        {
            $content = $this->user_repository->findById($user_id);
            $this->cache_service->set($cache_key, $content);

        }

        return $content;
    }

    public function add(User $a_new_user)
    {
        return $this->user_repository->add($a_new_user);
    }

    public function update(User $a_user)
    {
        return $this->user_repository->update($a_user);
    }

    public function delete(UserId $user_id)
    {
        return $this->user_repository->delete($user_id);
    }
}
