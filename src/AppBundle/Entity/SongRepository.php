<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SongRepository extends EntityRepository
{
    public function calculateAlbumRating(Album $album)
    {
        $qb = $this->createQueryBuilder('s')
            ->select("avg(s.rating)")
            ->where('s.album = :albumId')
            ->setParameter('albumId', $album);

        return round($qb->getQuery()->getSingleScalarResult(),1);
    }
    public function searchSongByTerm($term)
    {

        $qb = $this->createQueryBuilder('s')
            ->select("s")
            ->join('s.artist','a')
            ->join('s.album' ,'ab')
            ->where('ab.name like :term')
            ->orWhere('a.name like :term')
            ->orWhere('s.name like :term')
            ->setParameter('term', '%'.$term.'%');

        return $qb->getQuery()->execute();
    }

}