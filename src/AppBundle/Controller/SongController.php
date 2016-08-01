<?php
namespace AppBundle\Controller;

use AppBundle\Form\SongType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Collection;
use AppBundle\Form\SongCollectionType;
use AppBundle\Form\SongSingleType;
use AppBundle\Entity\Song;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Artist;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class SongController extends Controller
{

    /**
     * @Route("/song/rate", name="song_rating")
     */
    public function rateAction(Request $request)
    {
        $songId = $request->query->get('songId');
        $rating = $request->query->get('rating');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Song');
        $song = $repo->find($songId);
        $song->setRating($rating);
        $em->flush();
        $albumRating = $repo->calculateAlbumRating($song->getAlbum());
        $response = new JsonResponse([
            'status' => 1,
            'msg' => "Success! Your rating  for " . $song->getName() . " of " . $song->getRating() . " has been submitted successfully.",
            'rating' => $albumRating,
        ]);
        return $response;
    }

    /**
     * @Route("/song/delete", name="song_delete")
     */
    public function deleteAction(Request $request)
    {
        $songId = $request->query->get('songId');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Song');
        $song = $repo->find($songId);

        if (!$song) {
            throw $this->createNotFoundException('No song found for id ' . $songId);
        }

        $em->remove($song);
        $em->flush();

        $response = new JsonResponse([
            'status' => 1,
        ]);
        return $response;
    }

    /**
     * @Route("/add/song/new-song", name="song_new")
     */
    public function newSongAction(Request $request)
    {
        $song = new Song();
        $form = $this->createForm(SongSingleType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);
            $em->flush();
            return $this->redirectToRoute('song_add');
        }

        return $this->render('default/newSong.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/add/song", name="song_add")
     */
    public function addSongAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $songs = $em->getRepository('AppBundle:Song')->findAll();

        return $this->render('default/addSong.html.twig', [
            'songs' => $songs,
        ]);
    }

    /**
     * @Route("add/edit/song", name="song_edit")
     */
    public function editAction(Request $request)
    {
        $songId = $request->query->get('song-id');
        $em = $this->getDoctrine()->getManager();
        $song = $em->getRepository('AppBundle\Entity\Song')->find($songId);
        $form = $this->createForm(SongSingleType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);
            $em->flush();
            return $this->redirectToRoute('song_add');
        }

        return $this->render('default/newSong.html.twig', [
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("search/{term}", name="song_search")
     */
    public function searchAction(Request $request, $term)
    {
        $em = $this->getDoctrine()->getManager();
        $songs = $em->getRepository('AppBundle\Entity\Song')->searchSongByTerm($term);
        $error ='';

        if(!$songs){
            $error = 'Sorry, no song was found with these terms';
        }

        return $this->render('default/searchSong.html.twig', [
            'songs' => $songs, 'error' => $error,
        ]);


    }

}