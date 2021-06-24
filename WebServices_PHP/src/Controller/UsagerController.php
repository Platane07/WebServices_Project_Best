<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\UsagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsagerController extends AbstractController
{


    //Affiche l'espace usager si connecté (condition dans le template usager/index.html.twig)
    public function user(UsagerRepository $usagerRepository, SessionInterface $session): Response
    {
        if ($this->getUser()) {
            return $this->render('usager/index.html.twig', [
                'commandes' => $usagerRepository->getAllCommandes($this->getUser()),
                'usagerTheOne' => $this->getUser(),
                'usagers' => $usagerRepository->findAll()
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    //Affiche la partie admin du site si l'admin est connecté
    public function admin(UsagerRepository $usagerRepository, SessionInterface $session): Response
    {
        if ($this->getUser()) {
            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                return $this->render('pages/admin.html.twig', [
                    'commandes' => $usagerRepository->getAllCommandes($this->getUser()),
                ]);
            } else {
                return $this->redirectToRoute('index');
            }
        } else {
            return $this->redirectToRoute('app_login');
        }
    }


    //Lié à la page usager/new.html.twig, crée le formulaire et le nouvel usager 
    public function new(Request $request, SessionInterface $session, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        if ($session->has('id')) {
            return $this->redirectToRoute('usager_accueil');
        } else {
            $usager = new Usager();
            $form = $this->createForm(UsagerType::class, $usager);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $usager->setPassword(
                    $passwordEncoder->encodePassword(
                        $usager,
                        $form->get('plainPassword')->getData()
                    )
                );
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usager);
                $entityManager->flush();

                $session->set('id', $usager->getId());
            }

            return $this->render('usager/new.html.twig', [
                'usager' => $usager,
                'form' => $form->createView(),
            ]);
        }
    }
}
