<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route(
     *     "/{page}",
     *     name="home",
     *     requirements={"page"="\d+"},
     *     methods={"GET", "POST"}
     *     )
     */
    public function home(int $page=1)
    {
        $nextPage=$page+1;
        $previousPage=$page-1;
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repo->findBy([],[],20,($page-1)*20);

        $count= $repo->countAll();
        $maxPages = $count/20;
        return $this->render('movie/home.html.twig', [
            'movies'=>$movies,
            'previousPage'=>$previousPage,
            'nextPage'=>$nextPage,
            'count'=>$count,
            'maxPages'=>$maxPages,
            'controller_name' => 'MovieController',
        ]);
    }


    /**
     * @Route(
     *     "/detail/{id}",
     *     name="movie_detail",
     *     methods={"GET"}
     *     )
     */
    public function showDetail(int $id)
    {
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movie=$repo->find($id);
        return $this->render('movie/detail.html.twig', [
            'movie'=>$movie
    ]);
    }

    /**
     * @Route(
     *     "/watchlist/{id}",
     *     name="watchlist",
     *     )
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addWatchList(int $id)
    {


    }

}
