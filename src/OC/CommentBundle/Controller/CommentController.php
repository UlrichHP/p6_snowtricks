<?php

namespace OC\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\TrickBundle\Entity\Trick;
use OC\UserBundle\Entity\User;	
use OC\CommentBundle\Entity\Comment;
use OC\CommentBundle\Form\CommentType;

class CommentController extends Controller
{
    
    public function viewAction($trick, $page)
    {
    	$em = $this->getDoctrine()->getManager();
		$commentRepo = $em->getRepository('OCCommentBundle:Comment');
		$allComments = $commentRepo->findByTrick($trick);

		$totalComments = \count($allComments);
		$modulo = $totalComments % 10;
		$totalPages = (($totalComments - $modulo)/10) + 1;
		$offset = ($page - 1) * 10;
		$comments = $commentRepo->findByTrickWithLimit($trick, $offset);

		return $this->render('OCCommentBundle:Comment:comments.html.twig', array(
			'trick_id'		=> $trick,
			'comments'		=> 	$comments,
			'totalPages' 	=>	$totalPages,
			'actualPage'	=>	$page
		));
    }

	public function addAction($trick_id, $user_id, Request $request)
    {
		$comment = new Comment();
		$form = $this->get('form.factory')->create(CommentType::class, $comment, array(
				'action' => $this->generateUrl('oc_comment_add', array(
					'trick_id' 	=> 	$trick_id,
					'user_id'	=>	$user_id,
				)),
		));

		$trickRepo = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('OCTrickBundle:Trick')
        ;

        $trick = $trickRepo->find($trick_id);

        $userRepo = $this
    		->getDoctrine()
    		->getManager()
    		->getRepository('OCUserBundle:User')
		;
		$user = $userRepo->find($user_id);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$comment = $form->getData();
			$comment->setDate(new \DateTime());
			$comment->setTrick($trick);
			$comment->setAuthor($user);
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush($comment);

			return $this->redirectToRoute('oc_trick_view', array('slug' => $comment->getTrick()->getSlug()));
		}

        return $this->render('OCCommentBundle:Comment:add.html.twig', array(
        	'form' => $form->createView(),
        	'trick' => $trick,
    	));
    }
}
