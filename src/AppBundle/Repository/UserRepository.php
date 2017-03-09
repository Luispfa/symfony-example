<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findMostActiveUsers()
    {
        $queryBuilder = $this->createQueryBuilder('u');

        return $queryBuilder
            ->addSelect('p')
            ->join('u.posts', 'p')
            ->having(
                $queryBuilder->expr()->gte(
                    $queryBuilder->expr()->count('p'), 15
                )
            )
            ->groupBy('u')
            ->getQuery()
            ->getResult();
    }
}
