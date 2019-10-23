<?php


	namespace App\Controller;


	use App\Repository\PropertyRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class HomeController extends AbstractController
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
		 * @Route("/", name="home")
		 * @return \Symfony\Component\HttpFoundation\Response
		 */
		public function index(): Response
		{
			$properties = $this->repository->findLatest();
			return $this->render('pages/home.html.twig', [
				'current_menu' => 'properties',
				'properties' => $properties
			]);
		}

	}