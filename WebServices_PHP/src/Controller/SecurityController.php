<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{


    //Fonction qui affiche la page de connexion
    public function login(AuthenticationUtils $authenticationUtils, SessionInterface $session): Response
    {

        if ($this->getUser()) {
            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())){
                return $this->redirectToRoute('admin_accueil');
            }
            return $this->redirectToRoute('usager_accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    //Fonction utilisé pour se déconnecter
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
