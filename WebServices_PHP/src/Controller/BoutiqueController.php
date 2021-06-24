<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Service\BoutiqueService;
use App\Service\DeviseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController //Controller pour la boutique
{
    
    public function index(CategorieRepository $categories): Response
    {
        
        return $this->render('pages/boutique.html.twig', [
            'categories' => $categories->findAll(),
        ]);
    }

    public function rayon(Categorie $categorie = null, ArticleRepository $articles) : Response
    {
        if ($categorie == null){
            $this->redirectToRoute("boutique");
        }


        return $this->render('pages/rayon.html.twig', [ 
            'articles' => $articles->findBy(["categorie" => $categorie]),
        ]);
    }

    public function chercher(Request $request, ArticleRepository $articles) : Response
    {
        return $this->render('pages/chercher.html.twig', [
            'articles' => $articles->findArticlesByLibelleOrTexte($request->request->get("chercher")),
            'recherche' => $request->request->get("chercher")
        ]);

    }
}
