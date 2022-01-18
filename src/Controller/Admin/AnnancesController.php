<?php

namespace App\Controller\Admin;

use App\Entity\Annances;
use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\AnnancesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;


#[Route('/admin/annances')]
class AnnancesController extends AbstractController
{
    #[Route('/', name: 'admin_annances_index')]
    public function index(AnnancesRepository $annancesRepo, ): Response
    {

        $annances = $annancesRepo->findBy(array(),null,20,0);
        $nb=$annancesRepo->count(array());


        return $this->render('admin/annances/index.html.twig', [
            'annances'=> $annances,
            'nbpage'=> ceil($nb / 20)
        ]);
    }
//    #[Route('/{page}', name: 'admin_annances_index_by_page')]
//    public function afficher($page, AnnancesRepository $annancesRepo):Response
//    {
//        $annances = $annancesRepo->findBy([],[],20, ($page*20)-20);
//        return $this->render('admin/annances/indexpage.html.twig',[
//            'annances'=>$annances
//        ]);
//    }



    #[Route('/activer/{id}', name: 'activer')]
    public function activer(Annances $annance): Response
    {
       $annance->setActive(($annance->getAcitice()) ? false:true);

       $em = $this->getDoctrine()->getManager();
       $em->persist($annance);
       $em->flush();
       return new Response("true");
    }
    #[Route('/supprimer/{id}', name: 'admin_annances_supprimer')]
    public function supprimer(Annances $annance): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($annance);
        $em->flush();
        $this->addFlash('message','supprimer avec succes');
        return $this->redirectToRoute('admin_annances_index');
    }

    #[Route('/add', name: 'admin_annances_add')]
    public function addFormAnnances(Request $request): Response
    {

//        $annances = new annances();
//        $form = $this->createFormBuilder(data: []);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($annances);
//            $em->flush();



        return $this->render('admin/annances/add.html.twig', [
//            'form' => $form
        ]);


    }

    #[Route('/addannonce', name: 'admin_annances_add_ajax', methods: 'POST')]
    public function addAnnances(Request $request): Response
    {
        $title= $request->request->get('title');
        //var_dump($request->getContent());
        $body = $request->getContent();
        $data = json_decode($body, true);

//        $content = $request->request->get('Content');
//        echo($content);
        //echo $title;
        //var_dump($title);
        //var_dump($request->request->all());
//        var_dump($request->get('title')['title']);

        $annances = new annances();
        $annances->setTitle($data['title']);
        $annances->setContent($data['content']);


//
        $em = $this->getDoctrine()->getManager();
        $em->persist($annances);
        $em->flush();



        return new Response('ok');


    }
}
