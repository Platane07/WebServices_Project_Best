<?php

// src/Service/PanierService.php
namespace App\Service;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Usager;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
use App\Service\BoutiqueService;

// Service pour manipuler le panier et le stocker en session
class PanierService extends EntityRepository
{
    ////////////////////////////////////////////////////////////////////////////
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
    private $session;  // Le service Session
    private $articles; // Le service Boutique
    private $panier;   // Tableau associatif idarticle => quantite
    private $em;
    //  donc $this->panier[$i] = quantite du article dont l'id = $i
    // constructeur du service
    public function __construct(SessionInterface $session, ArticleRepository $articles, EntityManagerInterface $em)
    {
        // Récupération des services session et BoutiqueService

        $this->session = $session;
        $this->articles = $articles;
        $this->em = $em;
        // Récupération du panier en session s'il existe, init. à vide sinon
        if ($session->has('panier')) {
            $this->panier = $session->get('panier');
        } else {
            $this->panier = [];
        }
    }
    // getContenu renvoie le contenu du panier
    //  tableau d'éléments [ "article" => un article, "quantite" => quantite ]
    public function getContenu()
    { // à compléter
        $ind = 0;
        $contenu = [];
        foreach ($this->panier as $idArticle => $quantite) {
            $article = $this->articles->find(intval($idArticle));
            $article->quantite = $quantite;
            $contenu[$ind] = $article;
            $ind++;
        }
        return $contenu;
    }
    // getTotal renvoie le montant total du panier
    public function getTotal()
    { // à compléter
        $total = 0;
        $articles = $this->getContenu();
        foreach ($articles as $article) {
            $total = $total + $article->getPrix() * $article->quantite;
        }
        return $total;
    }
    // getNbArticles renvoie le nombre de articles dans le panier
    public function getNbArticles()
    { // à compléter 
        $total = 0;
        $articles = $this->getContenu();
        foreach ($articles as $article) {
            $total = $total + $article->quantite;
        }
        return $total;
    }
    // ajouterarticle ajoute au panier le article $idarticle en quantite $quantite 
    public function ajouterarticle(int $idArticle, int $quantite = 1)
    { // à compléter
        if (isset($this->panier[$idArticle])) {
            $this->panier[$idArticle] = $this->panier[$idArticle] + $quantite;
        } else {
            $this->panier[$idArticle] = $quantite;
        };
        $this->session->set('panier', $this->panier);
    }

    public function enleverarticle(int $idarticle, int $quantite = 1)
    {
        $this->panier[$idarticle] = $this->panier[$idarticle] - $quantite;

        if ($this->panier[$idarticle] == 0) {
            unset($this->panier[$idarticle]);
        }
        $this->session->set('panier', $this->panier);
    }
    // enleverarticle enlève du article
    // supprimerarticle supprime complètement le article $idarticle du panier
    public function supprimerArticle(int $idArticle)
    { // à compléter

        unset($this->panier[$idArticle]);
        $this->session->set('panier', $this->panier);
    }
    // vider vide complètement le panier
    public function vider()
    { // à compléter 
        $this->panier = [];
        $this->session->set('panier', $this->panier);
    }

    public function panierToCommande(Usager $usager)
    {

        $commande = new Commande();
        $date = new \DateTime('now');
        $commande->setUsager($usager)->setStatut("en attente")->setDateCommande($date);

        $this->em->persist($commande);
        $commande->getId();

        $this->em->flush();

        $articles = $this->getContenu();

        foreach ($articles as $article) {
            $ligneCommande = new LigneCommande();
            $ligneCommande->setCommande($commande)->setArticle($article)->setQuantite($article->quantite)->setPrix($this->getTotal());
            $this->em->persist($ligneCommande);
        }
        $this->em->flush();
        $this->vider();
        return $commande;
    }
}
