<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
	/**
     * @Route("/", name="main")
     */
    public function indexAction()
    {
    	$user = new User();
    	$form = $this->createForm(new UserType(), $user);

    	$request = $this->get('request');
    	$form->handleRequest($request);

        if ($request->getMethod() == 'POST')
        {
    		if ($form->isValid())
    		{
                $email =    $form->get('email')->getData();
                $username = $form->get('username')->getData();

                $user->setEmail($email);
                $user->setUsername($username);

                $test = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByEmail($email);
                $em = $this->getDoctrine()->getManager();
                $em->remove($test);
                $em->flush();

            	return new Response('Thank you for shopping with us '.$username);
    		}
	        return $this->render('AppBundle:Main:index.html.twig', array('form'=>$form->createView()));
    	}

        return $this->render('AppBundle:Main:index.html.twig', array('form'=>$form->createView()));
    }

}
