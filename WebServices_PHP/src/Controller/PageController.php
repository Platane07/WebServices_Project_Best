<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\LigneCommandeRepository;
use App\Service\DeviseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PanierService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Constraints\Length;

class PageController extends AbstractController //Controller utilisé pour la navigation générale dans le site
{

    //Route d'accueil du site
    public function index(SessionInterface $session): Response
    {

        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }


    //Page de contact
    public function contact(): Response 
    {
        return $this->render('pages/contact.html.twig');
    }

    //Affichage de la barre de navigation en haut
    public function navBar(SessionInterface $session, PanierService $panier, Request $request) : Response
    {
        //Récupère le nombre d'articles dans le panier
        $countPanier = $panier->getNbArticles();
        $route = $request->get('route');
        $routeParams = $request->get('params');
        $user = $this->getUser();

        return $this->render('components/navbar.html.twig', [
            'countPanier' => $countPanier,
            'route' => $route,
            'params' => $routeParams,
            'user' => $user
        ]);
    }


    //Affichage des produits les plus vendus
    public function sideBar(LigneCommandeRepository $ligneCommande, Request $request) : Response
    {


        $route = $request->get('route');
        $articles = $ligneCommande->getMostSoldArticles();

        //Trie les articles les plus vendus du plus petit au plus grand
        usort($articles, build_sorter('total'));
        $routeParams = $request->get('params');
            return $this->render('components/sidebar.html.twig', [
                'route' => $route,
                'params' => $routeParams,
                'articles' => $articles,
            ]);
    }

    //Fonction utilisé pour la modification de la forme des devises
    public function setDevise($devise, Request $request, DeviseService $deviseService){

        $deviseService->setDevise($devise);

        //Petite manipulation pour refresh la page proprement
        $request->getSession()
            ->getFlashBag();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);

    }


}


// Trie le tableau des articles les plus vendus pour les retourner du plus grand au plus petit
function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($b[$key], $a[$key]);
    };
}
