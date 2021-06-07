<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HumanRepository;
use App\Form\HumanType;
use App\Entity\Human;

/**
 * @Route("/human", name="human_")
 */
class HumanController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $human = new Human();
        $form = $this->createForm(HumanType::class, $human);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($human);
            $entityManager->flush();
            return $this->redirectToRoute('cat_index');
        }

        return $this->render('human/add.html.twig', [
            'human' => $human,
            'form' => $form->createView(),
        ]);
    }
}
