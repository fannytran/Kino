<?php

namespace App\Controller;

use App\Entity\Email;
use App\Entity\Movie;
use App\Form\AutreEmailType;
use App\Form\EmailType;
use App\Repository\MovieRepository;
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
     *     "/search",
     *     name="search",
     *     methods={"GET"}
     *     )
     */

    public function search(Request $request){

        $searchTitle= $request->query->get('title');
        $searchDirector= $request->query->get('director');
        $searchActors= $request->query->get('actors');

        $searchResult = [];
        if ($searchTitle != "" ){
            $searchResult[]=$searchTitle;
        }
        if ($searchDirector != "" ){
            $searchResult[]=$searchDirector;
        }
        if ($searchActors != "" ){
            $searchResult[]=$searchActors;
        }

        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repo->search($searchTitle,$searchDirector,$searchActors);


        return $this->render('movie/search.html.twig',[
            'movies'=>$movies,
            'searchResults'=>$searchResult
        ]);

    }

    /**
     * @Route(
     *     "/send-movie-details/{id}",
     *     name="send_details",
     *     requirements={"id"="\d+"},
     *     methods={"GET","POST"}
     *     )
     */

    public function sendMovieDetails(int $id, Request $request)
    {

        $user= $this->getUser();
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $movie=$repo->find($id);

        $email= new Email();

        $emailForm= $this->createForm(AutreEmailType::class, $email);
        $emailForm->handleRequest($request);
        //dd($emailForm);
        if($emailForm->isSubmitted() && $emailForm->isValid()){

           /*
            $content = $this->renderView('email/movie_details_mail_content.html.twig', [
                'movie'=>$movie,
                'message'=>$email->getMessage()
            ]);
        */
            $mail = new \Swift_Message();
            $mail->setTo($email->getSendAddress())
                ->setFrom($email->getUserEmail(), $user->getUsername())
                ->setSubject($email->getSubject())
               // ->setBody($content, 'text/html');
                ->setBody("hello !");

            $this->addFlash('success', "Thanks, your email has been sent !");

            return $this->redirectToRoute('movie_detail',[
                'id'=>$id
            ]);
        }

        return $this->render('movie/send_details.html.twig', [
            'emailForm'=>$emailForm->createView(),
            'user'=>$user,
            'movie'=>$movie,
        ]);

    }

}
