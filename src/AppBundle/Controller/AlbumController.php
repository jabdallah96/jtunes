<?php

namespace AppBundle\Controller;

use AppBundle\Form\AlbumType;
use AppBundle\Entity\Album;
use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Collection;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AlbumController extends Controller
{
    /**
     * @Route("/", name="album_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository('AppBundle:Album')->findAll();
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $term = $form->get('search')->getNormData();

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('song_search' , ['term' => $term]);
        }

        return $this->render('default/index.html.twig', [
            'albums' => $albums, 'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album/{albumId}", name="albumView")
     */
    public function viewAlbumAction($albumId)
    {
        $em = $this->getDoctrine()->getManager();
        $albumIndividual = $em->getRepository('AppBundle:Album')->find($albumId);

        $songs = $albumIndividual->getSongs();

        return $this->render('default/viewAlbum.html.twig', [
            'songs' => $songs,
            'album' => $albumIndividual,
        ]);
    }

    /**
     * @Route("/add/album", name="album_add")
     */
    public function addAlbumAction(Request $request)
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

        }

        return $this->render('default/addAlbum.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
