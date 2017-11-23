<?php

namespace OC\TrickBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TrickManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function checkIfExistWithSlug($slug)
    {
        $trick = $this
                    ->em
                    ->getRepository('OCTrickBundle:Trick')
                    ->findOneBySlug($slug);

        if ($trick === null) {
            throw new NotFoundHttpException();
        }

        return $trick;
    }
}
