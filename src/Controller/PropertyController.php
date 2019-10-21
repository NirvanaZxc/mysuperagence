<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 21/10/2019
 * Time: 22:14
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

	/**
	 * @Route("/biens", name="property.index")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(): Response
	{
		return $this->render("property/index.html.twig", [
		'current_menu' => 'properties'
		]);
	}
}