<?php
/**
 * Created by PhpStorm.
 * User: jad
 * Date: 7/24/16
 * Time: 2:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Album
{
    public $id;
    protected $name;
    protected $year;
    private $songs;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
    }

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


    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }


    public function addSong(Song $song)
    {
        if (!$this->songs->contains($song)) {
            $this->songs->add($song);
            $song->setAlbum($this);
        }
    }

    public function setSongs(ArrayCollection $songs)
    {
        foreach ($songs as $song) {
            $this->addSong($song);
        }
    }


    public function getSongs()
    {
        return $this->songs;
    }

    public function removeSong(Song $song)
    {
        $this->songs->removeElement($song);
    }

    public function getArtists()
    {
        $artists = [];
        foreach ($this->songs as $song) {
            $artists[] = $song->getArtist()->getName();
        }
        $artists = array_unique($artists);
        return $artists;
    }
}
