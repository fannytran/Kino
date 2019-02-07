<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder; //facultatif on peut appeler le singleton static du Container
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

    public function countAll()
    {
        $qb = $this->createQueryBuilder('q');
        $qb->select('count(q.id)');

       return $count = $qb->getQuery()->getSingleScalarResult();
    }

    public function search($searchTitle=null, $searchDirector=null, $searchActors=null)
    {
        $qb = $this->createQueryBuilder('q');
            if($searchTitle!="") {
                 $qb->andWhere("q.title LIKE :searchTitle");
                   $qb->setParameter(':searchTitle', '%' . $searchTitle . '%');
            }
            if($searchDirector!=""){
                $qb->andWhere("q.directors LIKE :searchDirector");
                $qb->setParameter(':searchDirector', '%' . $searchDirector . '%');
            }
            if($searchActors!=""){
                $qb->andWhere("q.actors LIKE :searchActors");
                $qb->setParameter(':searchActors', '%' . $searchActors . '%');
            }

        $movies=$qb->getQuery()->getResult();
        return $movies;
    }
}