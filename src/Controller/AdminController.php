<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/manage-movielist", name="admin_movielist")
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
}
