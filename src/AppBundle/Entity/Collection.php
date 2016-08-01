<?php
/**
 * Created by PhpStorm.
 * User: jad
 * Date: 7/27/16
 * Time: 11:38 AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Collection
{

    protected $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
    }



}