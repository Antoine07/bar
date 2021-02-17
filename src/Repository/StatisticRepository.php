<?php

namespace App\Repository;

use App\Entity\Statistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Array_;

/**
 * @method Statistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistic[]    findAll()
 * @method Statistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistic::class);
    }

    // /**
    //  * @return Statistic[] Returns an array of Statistic objects
    //  */

    public function findClients($value)
    {
        return $this->createQueryBuilder('s')
            ->join('s.clients', 'c')
            ->getQuery()
            ->getResult()
        ;

    }

    // public function conso(string $order = 'ASC')
    // {
    //     $em = $this->getEntityManager();
    //     $dql = '
    //         SELECT c, COUNT(c.id) as nb
    //         FROM App\Entity\Client c
    //         JOIN c.statistics s
    //         GROUP BY c.id
    //         ORDER BY nb
    //     ';

    //     $query = $em->createQuery($dql);

    //     return $query->getResult();

    // }

    public function conso(string $order = 'ASC')
    {
        $em = $this->getEntityManager();
        $dql = '
            SELECT s, b, c.id
            FROM App\Entity\Statistic s
            JOIN s.client c
            JOIN s.beer b
        ';

        $query = $em->createQuery($dql);

        return $query->getResult();

    }
 
    /*
    public function findOneBySomeField($value): ?Statistic
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
