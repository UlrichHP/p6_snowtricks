<?php

namespace OC\TrickBundle\Controller;

use OC\TrickBundle\Entity\Trick;
use OC\TrickBundle\Service\TrickManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;

class TrickController extends Controller
{
    public function indexAction()
    {
        $tricks = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCTrickBundle:Trick')
            ->getTricks()
        ;

        return $this->render('OCTrickBundle:Trick:index.html.twig', array(
            'tricks' => $tricks,
        ));
    }
    
    public function viewAction($slug)
    {
        $trick = $this->container->get('oc_trick.trickmanager')->checkIfExistWithSlug($slug);

        return $this->render('OCTrickBundle:Trick:view.html.twig', array(
            'trick' => $trick,
        ));
    }
    
}
