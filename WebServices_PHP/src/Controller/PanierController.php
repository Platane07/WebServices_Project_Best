<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Service\MailerService;
use App\Service\PanierService;
use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends AbstractController //Controller utilisé pour les fonctions du panier
{


    //Affichage du panier
    public function index(PanierService $panier): Response
    {
        $articles = $panier->getContenu();
        $total = $panier->getTotal();

        return $this->render('pages/panier.html.twig', [
            'articles' => $articles,
            'total' => $total,
        ]);
    }

    //Ajouter un article
    public function ajouter(PanierService $panier, $idArticle, $quantite): Response
    {

       $panier->ajouterArticle($idArticle, $quantite);

       return $this->redirectToRoute('panier');
    }


    //Enlever une fois un article du panier
    public function enlever(PanierService $panier, $idArticle, $quantite): Response
    {

       $panier->enleverArticle($idArticle, $quantite);

       return $this->redirectToRoute('panier');
    }

    //Supprimer toutes les instances d'un article du panier
    public function supprimer(PanierService $panier, $idArticle): Response
    {

       $panier->supprimerArticle($idArticle);

       return $this->redirectToRoute('panier');
    }

    //Supprimer tous les articles du panier
    public function vider(PanierService $panier): Response
    {
        $panier->vider();
        return $this->redirectToRoute('panier');
    }


    //Fonction qui permet de créer une commande et qui vide le panier
    public function commande(MailerService $mailer, PanierService $panier, SessionInterface $session): Response
    {


        //L'utilisateur est obligé d'avoir un compte pour pouvoir passer commande
        if ($this->getUser()){
            //Si le panier n'a pas de contenu la commande n'est pas effectuée
            if ($panier->getContenu() != []) {
                $commande = $panier->panierToCommande($this->getUser());

                $mailer->send($this->getUser()->getUsername(), $commande);
                return $this->render('pages/commande.html.twig', [
                    'commande' => $commande,
                ]);
            } else {
                return $this->redirectToRoute('panier');
            }
        }

        return $this->redirectToRoute('app_login');

    }
    
}
