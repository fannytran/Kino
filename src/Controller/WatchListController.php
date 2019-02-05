<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\WatchListItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WatchListController extends AbstractController
{
    /**
     * @Route("/watchlist", name="watchlist")
     */
    public function showWatchList()
    {
        $user=$this->getUser();
        $repo= $this->getDoctrine()->getRepository(WatchListItem::class);
        $movies=$repo->findBy([],[],[],[]);
        //@todo
        return $this->render('watch_list/watchList.html.twig', [
            'user'=>$user,
            'movies'=>$movies,
            'controller_name' => 'WatchListController',
        ]);
    }

    /**
     * @Route(
     *     "/add-to-my-watchlist/{id}",
     *     name="watchlist_item",
     *     requirements={"id"="\d+"},
     *     )
     */
    public function addToWatchList(int $id)
    {
        $user= $this->getUser();
        $repo= $this->getDoctrine()->getRepository(Movie::class);
        $movie=$repo->find($id);

        $wlItem = new WatchListItem();
        $wlItem->setMovie($movie);
        $wlItem->setUser($user);
        $wlItem->setDateAdded(new \DateTime);

        $em=$this->getDoctrine()->getManager();
        $em->persist($wlItem);
        $em->flush();

        return $this->redirectToRoute('movie_detail',[
            'id'=>$movie->getId()
        ]);
    }
}
