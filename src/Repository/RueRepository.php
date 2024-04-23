<?php

namespace App\Repository;

use App\Entity\Rue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rue>
 *
 * @method Rue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rue[]    findAll()
 * @method Rue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rue::class);
    }

    //    /**
    //     * @return Rue[] Returns an array of Rue objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Rue
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
