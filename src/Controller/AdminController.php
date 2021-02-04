<?php

namespace App\Controller;

use App\Entity\Fruit;
use App\Entity\Recept;
use App\Form\FruitFormType;
use App\Form\ReceptFormType;
use App\Repository\ReceptRepository;
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
    /**
     * @Route("/admin/recipes", name="recipe_table")
     */
    public function showRecipeTable()
    {
        $r = $this->getDoctrine()->getRepository(Recept::class);
        $recipes = $r->findAll();
        return $this->render('admin/recipeTable.html.twig', [
            "recipes" => $recipes
        ]);
    }
}



/*
 *
fruit
 'abrikoos', 'zomer'
 'banaan', 'jaar'
 'citroen', 'jaar'
 'appel', 'herfst'
 'druif', 'herfst'
 'kruisbes', 'herfst'
 'braam', 'zomer'

recepten
appeltaartijs', 'gooi room bij appel, kers en melk, kook het mengsel en voeg 1 kilo suiker toe. Laat afkoelen bij kamertemperatuur.', '18.00'
 'chocomousseijs', 'Smelt 400 g melkchocolade au bain marie, klop 500 g slagroom op. Meng een ei door de chocolade en schep die door de slagroom. Laat de chocomousse al draaiend opstijven en zet daarna in de koelkast. Max 4 graden celsius afkoelen.', '12.00'
drakenfruitijs', 'Schep het drakenfruit leeg. Maak een halve liter slagroom. Schep het fruit door de slagroom. Koel het mensgel', '14.00'
blauwebessenijs', 'Kook de blauwe bessen (1000 g). Kook boerenmelk en laat afkoelen. Sla room tot punten. Meng door de afgekoelde melk. Meng de blauwe bessen door de melk. Laat alles afkoelen.', '15.00'
 'citroenijs', 'Rasp citroenschil. Kook de schil en laat afkoelen. Pers 4 citroenen uit. Meng het sap met 250 g suiker. Klop een halve liter slagroom op. Schep dat door het citroensap. Voeg een halve liter sojamelk toe. Laat het mengsel langzaam afkoelen.', '9.00'
kruisbessenijs', '2 kilo kruisbessen verpulveren. Mengen met sorbetijs en door de mascarpone scheppen.', '45.50'
bramenijs', 'Kook de bramen stuk. Voeg 1:1 suiker toe en 1:2 room. Kook de room in, voeg 100 g pure chocolade toe en laat het mengsel afkoelen. Schep slagroom door het mengsel.', '16.50'

 */