<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/movielist", name="admin_movielist")
     */
    public function showMovieList()
    {

        //$user = $this->getUser();
        //$role=$user->getRoles();
        //dd($role);
        if($this->isGranted("ROLE_ADMIN")){

            $repo= $this->getDoctrine()->getRepository(Movie::class);
            $movies=$repo->findAll();
           // dd($movies);
            $count = $repo->countAll();

        }

        return $this->render('admin/movieList.html.twig', [
            'movies'=>$movies,
            'count'=>$count
        ]);
    }

    /**
     * @Route(
     *     "/admin/add-movie",
     *     name="admin_addMovie",
     *     methods={"GET", "POST"}
     *     )
     */
    public function addMovie(Request $request)
    {
        $movie= new Movie();
        $movieForm = $this->createForm(MovieType::class);
        $movieForm->handleRequest($request);

        if($movieForm->isSubmitted() && $movieForm->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash("success", "Thanks, movie added !");
            return $this->redirectToRoute('admin_movielist');
        }

        return $this->render('admin/add_movie.html.twig', [
            "movieForm"=>$movieForm->createView()
        ]);
    }

    /**
     * @Route(
     *     "/admin/update-movie/{id}",
     *     name="admin_updateMovie",
     *     methods={"GET", "POST"},
     *     requirements={"id"="\d+"},
     *     )
     */
    public function updateMovie(Request $request, int $id)
    {
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movie=$repo->find($id);
       // dd($movie);

        $movieForm = $this->createForm(MovieType::class, $movie);
        $movieForm->handleRequest($request);

        if($movieForm->isSubmitted() && $movieForm->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash("success", "Thanks, movie updated !");
            return $this->redirectToRoute('admin_movielist');
        }

        return $this->render('admin/udpate_movie.html.twig', [
            "movieForm"=>$movieForm->createView(),
            "movie"=>$movie
        ]);
    }

    /**
     * @Route(
     *     "/admin/remove-movie/{id}",
     *     name="admin_removeMovie",
     *     methods={"GET", "POST"},
     *     requirements={"id"="\d+"},
     *     )
     */

    //impossible si dans une watchlist
    public function removeMovie(int $id)
    {
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movie=$repo->find($id);

        if ($movie->getWatchListItems()->isEmpty()){
            $em= $this->getDoctrine()->getManager();
            $em->remove($movie);
            $em->flush();

            $this->addFlash("success", " movie deleted !");

        }else{

            $this->addFlash("warning", "Can't be deleted! this movie belongs to watchlist !");
        }

        return $this->redirectToRoute('admin_movielist');
    }

}
