<?php

namespace OC\TrickBundle\Controller;

use OC\TrickBundle\Entity\Trick;
use OC\TrickBundle\Service\TrickManager;
use OC\TrickBundle\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;

class TrickController extends Controller
{
    public function indexAction($page)
    {
		if ($page < 1) {
			throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
		}
		
		$nbPerPage = 4;
		
        $tricks = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCTrickBundle:Trick')
            ->getTricks($page, $nbPerPage)
        ;
		
		$nbPages = ceil(count($tricks) / $nbPerPage);
		
		if ($page > $nbPages) {
			throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
		}

        return $this->render('OCTrickBundle:Trick:index.html.twig', array(
            'tricks' => $tricks,
			'nbPages' => $nbPages,
			'page' => $page,
        ));
    }
    
    public function viewAction($slug)
    {
        $trick = $this->container->get('oc_trick.trickmanager')->checkIfExistWithSlug($slug);

        return $this->render('OCTrickBundle:Trick:view.html.twig', array(
            'trick' => $trick,
        ));
    }
    
	public function addAction(Request $request)
    {
        $trick = new Trick();
        $form = $this->get('form.factory')->create(TrickType::class, $trick);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();
            
            $this->addFlash('success', "La Figure a bien été créée !");
            return $this->redirectToRoute('oc_trick_homepage');
        }
        
        return $this->render('OCTrickBundle:Trick:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function editAction($slug, Request $request)
    {
        $trick = $this->container->get('oc_trick.trickmanager')->checkIfExistWithSlug($slug);

        $illustrations = new ArrayCollection();
        foreach ($trick->getPictures() as $picture) {
            $illustrations->add($picture);
        }

        $trickVideos = new ArrayCollection();
        foreach ($trick->getVideos() as $video) {
            $trickVideos->add($video);
        }

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $trick = $form->getData();
            foreach ($illustrations as $picture) {
                if (false === $trick->getPictures()->contains($picture)) {
                    $em->remove($picture);
                }
            }
            foreach ($trickVideos as $video) {
                if (false === $trick->getVideos()->contains($video)) {
                    $em->remove($video);
                }
            }

            $em->persist($trick);
            $em->flush();
			
			$this->addFlash('info', "La Figure a été modifiée !");
			
            return $this->redirectToRoute('oc_trick_view', array(
                'slug' => $trick->getSlug(),
            ));
        }

        return $this->render('OCTrickBundle:Trick:edit.html.twig', array(
            'trick' =>  $trick,
            'form'  =>  $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $trick = $em->getRepository('OCTrickBundle:Trick')->find($id);

        if ($trick === null) { // display an error if the Trick doesn't exist
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($trick);
            $em->flush();

            $this->addFlash('danger', "La Figure a été supprimée !");

            return $this->redirectToRoute('oc_trick_homepage');
        }

        return $this->render('OCTrickBundle:Trick:delete.html.twig', array(
            'trick'     =>  $trick,
            'form'      =>  $form->createView(),
        )); 
        
    }
	
}
