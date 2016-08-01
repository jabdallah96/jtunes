<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Collection;
use AppBundle\Form\ArtistType;
use AppBundle\Form\ArtistCollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ArtistController extends Controller
{
    /**
     * @Route("/add/artist", name="artist_add")
     */
    public function addArtistAction(Request $request)
    {

        $collection = new Collection();

        $empty = new Artist();
        $empty->setName('');
        $collection->getCollection()->add($empty);

        $form = $this->createForm(ArtistCollectionType::class, $collection);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($collection->getCollection() as $artist){
                $artistCheck = $em->getRepository('AppBundle:Artist')->findOneByName($artist->getName());

                if (!$artistCheck) {
                    $em->persist($artist);
                    $em->flush();
                    return $this->redirectToRoute('album_index');
                }

            }
        }

        return $this->render('default/addArtist.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
}
