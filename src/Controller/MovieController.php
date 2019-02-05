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
     *     "/",
     *     name="home",
     *     methods={"GET", "POST"}
     *     )
     */
    public function home()
    {

        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repo->showMovie();

       // var_dump($movies);
        //die();
        return $this->render('movie/home.html.twig', [
            'movies'=>$movies,
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
     *
     *     )
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addWatchList(int $id){

        $repo = $this->getDoctrine()->getRepository(Movie::class);



        return $this->render('movie/watchList.html.twig',[
           'movies'=>$movies
        ]);
    }

}
