<?php

namespace App\Controller;

use App\Entity\Annances;
use App\Form\AnnancesType;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig');
//

    }

    #[Route('/users/annances/ajout', name: 'users_annances_ajout')]
    public function ajoutAnnances(Request $request): Response
    {
        $annance = new Annances;

        $form= $this->createForm(AnnancesType::class, $annance);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $annance->setUsers($this->getUser());
            $annance->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($annance);
            $em->flush();

return $this->redirectToRoute('users');
        }

        return $this->render('users/annances/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/users/profil/modifier', name: 'users_profil_modifier')]
    public function editprofile(Request $request): Response
    {
        $user= $this->getUser();


        $form= $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message', 'Profil mise a jour');
            return $this->redirectToRoute('users');
        }

        return $this->render('users/editprofil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/users/pass/modifier', name: 'users_pass_modifier')]
    public function editpass(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
if($request->isMethod('POST')){
    $em = $this->getDoctrine()->getManager();

    $user = $this->getUser();
        if($request->request->get('pass') == $request->get('pass2')){
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
            $em->flush();
            $this->addFlash('message', 'Mot de passe mise ajour avec succes');

            return $this->redirectToRoute('users');

        }else{
            $this->addFlash('error', 'les mots de pass ne sont pas identiques ');
        }
}

        return $this->render('users/editpass.html.twig');
    }
}
