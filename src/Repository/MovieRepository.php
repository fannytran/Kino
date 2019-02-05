<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder; //facultatif on peut appeler le singleton static
use Doctrine\ORM\Tools\Pagination\Paginator; //pour afficher le result dql
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function showMovie(){

        // SELECT * FROM movieORDER BY RAND() LIMIT 40

        $qb = $this->createQueryBuilder('q')
                ->orderBy('q.id')
                ->setMaxResults(40);


        $query = $qb->getQuery();
        $movies = $query->getResult();

        return $movies;
    }

    public function countAll()
    {
        $qb = $this->createQueryBuilder('q');
        $qb->select('count(q.id)');

       return $count = $qb->getQuery()->getSingleScalarResult();
    }
}