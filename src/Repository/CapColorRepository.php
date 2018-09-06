<?php

namespace App\Repository;

use App\Entity\CapColor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CapColor|null find($id, $lockMode = null, $lockVersion = null)
 * @method CapColor|null findOneBy(array $criteria, array $orderBy = null)
 * @method CapColor[]    findAll()
 * @method CapColor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapColorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CapColor::class);
    }

//    /**
//     * @return CapColor[] Returns an array of CapColor objects
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
    public function findOneBySomeField($value): ?CapColor
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
