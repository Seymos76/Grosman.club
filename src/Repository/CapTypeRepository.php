<?php

namespace App\Repository;

use App\Entity\CapType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CapType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CapType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CapType[]    findAll()
 * @method CapType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CapType::class);
    }

//    /**
//     * @return CapType[] Returns an array of CapType objects
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
    public function findOneBySomeField($value): ?CapType
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
