<?php

namespace App\Repository;

use App\Entity\WatchListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WatchListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method WatchListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method WatchListItem[]    findAll()
 * @method WatchListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchListItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WatchListItem::class);
    }

    // /**
    //  * @return WatchListItem[] Returns an array of WatchListItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WatchListItem
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
