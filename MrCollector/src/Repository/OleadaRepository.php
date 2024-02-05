<?php

namespace App\Repository;

use App\Entity\Oleada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oleada>
 *
 * @method Oleada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oleada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oleada[]    findAll()
 * @method Oleada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OleadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oleada::class);
    }

//    /**
//     * @return Oleada[] Returns an array of Oleada objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Oleada
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
