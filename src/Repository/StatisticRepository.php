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

    public function conso()
    {
        $em = $this->getEntityManager();
        $dql = '
            SELECT c, s
            FROM App\Entity\Client c
            JOIN c.statistics s
            ORDER BY c.number_beer DESC
        ';

        $query = $em->createQuery($dql);

        return $query->getResult();
    }

    public function statInfo()
    {
        $em = $this->getEntityManager();
        $dql = '
            SELECT FORMAT(STD(c.number_beer), 2) AS std, 
            MIN(c.number_beer) AS min, 
            MAX(c.number_beer) AS max, 
            AVG(c.number_beer) AS avg,
            COUNT(c.id) AS nb_client,
            SUM(c.number_beer) AS nb_beer
            FROM App\Entity\Client c
        ';

        $query = $em->createQuery($dql);

        return $query->getResult();
    }

   

    // /**
        //  * @return Beer[] Returns an array of Beer objects
    //  */
    public function getIds($min = 16, $max = 20)
    {
        return $this->createQueryBuilder('s')
            ->select('b.id, s.score')
            ->where('s.score BETWEEN :min AND :max')
            ->join('s.beer', 'b') 
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->getQuery()
            ->getResult();
    }
}
