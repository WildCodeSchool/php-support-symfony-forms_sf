<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Form\CatType;
use App\Repository\CatRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route(name="cat_")
 */
class CatController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CatRepository $catRepository): Response
    {
        $cats = $catRepository->findAll();
        return $this->render('cat/index.html.twig', [
            'cats' => $cats,
        ]);
    }

    /**
     * @Route("/cat/add", name="add")
     */
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $cat = new Cat();
        $form = $this->createForm(CatType::class, $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cat);
            $entityManager->flush();
            return $this->redirectToRoute('cat_index');
        }

        return $this->render('cat/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
