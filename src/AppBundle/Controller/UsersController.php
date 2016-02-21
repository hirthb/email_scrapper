<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

	/**
	 *	@return array
	 *	@View()
	 */
	public function getUsersAction() {
		$users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
		return $users;
	}

	/**
	 *
	 *	@View()]
	 */
	public function postUserAction() {
		$user = new User();
		
		$request = $this->get('request');
    	$email = $request->request->get('email');
    	$username = $request->request->get('username');

        $user->setEmail($email);
		$user->setUsername($username);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

		return new Response('Created user '.$email);
	}

}