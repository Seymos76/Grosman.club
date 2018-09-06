<?php

namespace App\Repository;

use App\Entity\CapPatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CapPatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CapPatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CapPatch[]    findAll()
 * @method CapPatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapPatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CapPatch::class);
    }

//    /**
//     * @return CapPatch[] Returns an array of CapPatch objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CapPatch
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
