<?php
/// src/AppBundle/Twig/AlbumExtension.php
namespace AppBundle\Twig;

use AppBundle\Entity\Album;
use Symfony\Bridge\Doctrine\RegistryInterface;


class AlbumExtension extends \Twig_Extension
{

    protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('artist', array($this, 'artistFilter')),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getAlbumRating', array($this, 'getAlbumRating')),
        ];
    }

    public function artistFilter(Album $album)
    {
        return implode(', ', $album->getArtists());
    }

    public function getAlbumRating($albumId)
    {
        $album = $this->doctrine->getRepository('AppBundle:Album')->find($albumId);
        return $this->doctrine->getRepository('AppBundle:Song')->calculateAlbumRating($album);
    }

    public function getName()
    {
        return 'app_extension';
    }
}