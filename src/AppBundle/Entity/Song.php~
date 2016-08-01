<?php
// src/AppBundle/Entity/Song.php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Song
{
    public $id;

    protected $name;
    private $genre;
    protected $rating;

    public function getId()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }


    public function getRating()
    {
        return $this->rating;
    }

    private $artist;


    private $album;



    public function setArtist(\AppBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }


    public function getArtist()
    {
        return $this->artist;
    }


    public function setAlbum(\AppBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }


    public function getAlbum()
    {
        return $this->album;
    }




    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }


    public function getGenre()
    {
        return $this->genre;
    }
}
