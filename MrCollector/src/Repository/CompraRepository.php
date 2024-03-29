<?php

namespace App\Repository;

use App\Entity\Compra;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Compra>
 *
 * @method Compra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compra[]    findAll()
 * @method Compra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compra::class);
    }

    // En tu CompraRepository.php
public function findComprasByUser(User $user)
{
    return $this->createQueryBuilder('c')
        ->join('c.user', 'u')
        ->join('c.objeto', 'o')
        ->join('o.fabricante', 'f')
        ->join('o.oleada', 'ol')
        ->where('u.id = :userId')
        ->setParameter('userId', $user->getId())
        ->getQuery()
        ->getResult();
}


//    /**
//     * @return Compra[] Returns an array of Compra objects
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

//    public function findOneBySomeField($value): ?Compra
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
