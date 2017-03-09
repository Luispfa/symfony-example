<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ForumRepository extends EntityRepository
{
    public function findMostActiveForums()
    {
        $queryBuilder = $this->createQueryBuilder('f');

        return $queryBuilder
            ->join('f.posts', 'p')
            ->having(
                $queryBuilder->expr()->gte(
                    $queryBuilder->expr()->count('p'), 5
                )
            )
            ->groupBy('f')
            ->getQuery()
            ->getResult();
    }
}
