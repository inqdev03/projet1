<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/categories')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'admin_categories_index')]
    public function index(CategoriesRepository $catsRepo): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $catsRepo->findAll()
        ]);
    }



    #[Route('/ajout', name: 'admin_categories_ajout')]
    public function ajoutCategorie(Request $request): Response
    {
        $categorie = new Categories();
        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_index');


        }
        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/modifier/{id}', name: 'admin_categories_modifier')]
    public function ModifCategorie(categories $categorie, Request $request): Response
    {


        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_index');


        }
        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
