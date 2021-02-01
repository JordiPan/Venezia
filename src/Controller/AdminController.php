<?php

namespace App\Controller;

use App\Entity\Fruit;
use App\Entity\Recept;
use App\Form\FruitFormType;
use App\Form\ReceptFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/add/recept", name="add_recept")
     */
    public function addRecept(Request $request)
    {
        $recept = new Recept();
        $form = $this->createForm(ReceptFormType::class, $recept);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recept);
            $entityManager->flush();
            $this->addFlash('success', 'Recept is toegevoegd!');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/addRecept.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/add/fruit", name="add_fruit")
     */
    public function addFruit(Request $request)
    {
        $fruit = new Fruit();
        $form = $this->createForm(FruitFormType::class, $fruit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fruit);
            $entityManager->flush();
            $this->addFlash('success', 'Fruit is toegevoegd!');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/addFruit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
