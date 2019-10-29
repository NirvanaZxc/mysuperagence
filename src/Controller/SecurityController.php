<?php


	namespace App\Controller;


	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

	class SecurityController extends AbstractController
	{
		/**
		 * @Route("/login", name="login")
		 * @param AuthenticationUtils $authenticationUtils
		 */
		public function login(AuthenticationUtils $authenticationUtils)
		{

		}
	}