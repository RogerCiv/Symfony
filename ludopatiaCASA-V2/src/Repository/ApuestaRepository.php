<?php

namespace App\Repository;

use App\Entity\Apuesta;
use App\Entity\NumerosLoteria;
use App\Entity\Sorteo;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Apuesta>
 *
 * @method Apuesta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apuesta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apuesta[]    findAll()
 * @method Apuesta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApuestaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apuesta::class);
    }

    public function existsApuestaForNumeroLoteriaAndSorteo(NumerosLoteria $numeroLoteria, Sorteo $sorteo): bool
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.numeroLoteria = :numeroLoteria')
            ->andWhere('a.sorteo = :sorteo')
            ->setParameter('numeroLoteria', $numeroLoteria)
            ->setParameter('sorteo', $sorteo)
            ->getQuery()
            ->getOneOrNullResult() !== null;
    }
     /**
     * @param User $user
     * @return Apuesta[] Returns an array of Apuesta objects
     */
    public function hasUserWonAnySorteo(User $user): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.sorteo', 's')
            ->join('a.numeroLoteria', 'nl')
            ->andWhere('a.user = :user')
            ->andWhere('s.state = 1')
            ->andWhere('s.winner = nl.numero')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Apuesta[] Returns an array of Apuesta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Apuesta
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
