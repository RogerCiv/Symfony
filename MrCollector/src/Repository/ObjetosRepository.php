<?php

namespace App\Repository;

use App\Entity\Objetos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Objetos>
 *
 * @method Objetos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objetos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objetos[]    findAll()
 * @method Objetos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objetos::class);
    }

//    /**
//     * @return Objetos[] Returns an array of Objetos objects
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

//    public function findOneBySomeField($value): ?Objetos
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
