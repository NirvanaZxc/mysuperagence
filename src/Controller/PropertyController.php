<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 21/10/2019
 * Time: 22:14
 */

namespace App\Controller;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
	/**
	 * PropertyController constructor.
	 * @var PropertyRepository $repository
	 */
	private $repository;

	public function __construct(PropertyRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @Route("/biens", name="property.index")
	 * @return Response
	 */
	public function index(): Response
	{
		$properties = $this->repository->findLatest();
		return $this->render("property/index.html.twig", [
			'current_menu' => 'properties',
			'properties' => $properties
		]);
	}

	/**
	 * @Route("/beins/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
	 * @param Property $property
	 * @param string $slug
	 * @return Response
	 */
	public function show(Property $property, string $slug): Response
	{
		if ($property->getSlug() !== $slug) {
			return $this->redirectToRoute('property.show', [
				'id' => $property->getId(),
				'slug' => $property->getSlug()
			], 301);
		}
		return $this->render("property/show.html.twig", [
			'current_menu' => 'properties',
			'property' => $property
		]);
	}
}