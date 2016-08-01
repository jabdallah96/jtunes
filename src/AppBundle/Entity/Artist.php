<?php
/**
 * Created by PhpStorm.
 * User: jad
 * Date: 7/24/16
 * Time: 2:18 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;


class Artist
{
    public $id;
    protected $name;
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


    public function addSong(\AppBundle\Entity\Song $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    public function removeSong(\AppBundle\Entity\Song $song)
    {
        $this->songs->removeElement($song);
    }

    public function getSongs()
    {
        return $this->songs;
    }
}
