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
        $userId=$user->getId();
        $repo= $this->getDoctrine()->getRepository(WatchListItem::class);
        $wlItems=$repo->findBy(['user'=>$userId]);
           // dd($wlItems);
        return $this->render('watch_list/watchList.html.twig', [
            'user'=>$user,
            'wlItems'=>$wlItems
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
        //@todo validate unicity of (user/movie)

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
