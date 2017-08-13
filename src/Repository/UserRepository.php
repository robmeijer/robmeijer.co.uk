<?php

namespace App\Repository;

use App\Entity\User;
use App\Pagination\Pageable;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use Pageable;

    public function findAllPaginated($page = 1, $limit = User::LIMIT)
    {
        return $this->paginate($this->createQueryBuilder('u')->getQuery(), $page, $limit);
    }
}
