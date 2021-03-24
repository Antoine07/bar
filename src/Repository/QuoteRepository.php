<?php

namespace App\Repository;

use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    // /**
    //  * @return Quote[] Returns an array of Quote objects
    //  */

    // public function findByPositionOrder($order = 'DESC', $limit = 10)
    // {
    //     return $this->createQueryBuilder('q')
    //         ->orderBy('q.position', $order)
    //         ->setMaxResults($limit)
    //         ->getQuery()
    //         ->getResult();
    // }

    public function quotes($status, $order = 'ASC')
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.position = :val')
            ->orderBy('q.created_at', $order)
            ->setParameter('val', $status)
            ->getQuery()
            ->getResult();
    }
}
