<?php

namespace App\Repository;

use App\Entity\Coleccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coleccion>
 *
 * @method Coleccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coleccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coleccion[]    findAll()
 * @method Coleccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColeccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coleccion::class);
    }

//    /**
//     * @return Coleccion[] Returns an array of Coleccion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coleccion
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
