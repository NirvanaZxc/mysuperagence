<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 27/10/2019
 * Time: 15:53
 */

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
	/**
	 * @var PropertyRepository
	 */
	private $repository;
	/**
	 * @var ObjectManager
	 */
	private $em;

	/**
	 * AdminPropertyController constructor.
	 * @param PropertyRepository $repository
	 * @param ObjectManager $em
	 */
	public function __construct(PropertyRepository $repository, ObjectManager $em)
	{
		$this->repository = $repository;

		$this->em = $em;
	}

	/**
	 * @Route("/admin", name="admin.property.index")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index() :Response
	{
		$properties = $this->repository->findAll();

		return $this->render('admin/property/index.html.twig', compact('properties'));
	}

	/**
	 * @Route("/admin/property/create", name="admin.property.new")
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function new(Request $request)
	{
		$property = new Property();
		$form = $this->createForm(PropertyType::class, $property);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid())
		{
			$this->em->persist($property);
			$this->em->flush();

			return $this->redirectToRoute('admin.property.index');
		}

		return $this->render("admin/property/new.html.twig", [
			'property' => $property,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/admin/property/{id}", name="admin.property.edit")
	 * @param Property $property
	 * @param Request $request
	 * @return Response
	 */
	public function edit(Property $property, Request $request)
	{
		$form = $this->createForm(PropertyType::class, $property);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid())
		{
			$this->em->flush();

			return $this->redirectToRoute('admin.property.index');
		}
		return $this->render("admin/property/edit.html.twig", [
			'property' => $property,
			'form' => $form->createView()
		]);
	}
}