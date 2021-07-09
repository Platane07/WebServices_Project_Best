<?php

namespace App\Soap;

use Doctrine\Persistence\ManagerRegistry;
use App\Soap\ArticleSoap;
use App\Soap\CategorieSoap;

/**
 * Class SoapOperations
 * @package App\Soap
 */
class SoapOperations
{
    private $doct;

    /**
     * SoapOperations constructor.
     * @param ManagerRegistry $doct
     */
    public function __construct(ManagerRegistry $doct)
    {
        $this->doct = $doct;
    }

    /**
     * Dis "Hello" à la personne passée en paramètre
     * @param string $name Le nom de la personne à qui dire "Hello!"
     * @return string The hello string
     */
    public function sayHello(string $name): string
    {
        return 'Hello ' . $name . '!';
    }

    /**
     * Réalise la somme de deux entiers
     * @param int $a 1er nombre
     * @param int $b 2ème nombre
     * @return int La somme des deux entiers
     */
    public function sumHello(int $a, int $b): int
    {
        return (int)($a + $b);
    }

    /**
     * @param float $a
     * @param float $b
     * @param float $c
     * @return float
     */
    public function sumFloats(float $a, float $b, float $c): float
    {
        return (float)($a + $b + $c);
    }

    /**
     * Récupère le libellé d'un article dont on connaît l'id
     * @param int $id
     * @return \App\Soap\ArticleSoap Le secteur avec l'id et le libellé
     */
    public function getArticleById($id)
    {
        $article = $this->doct->getRepository(\App\Entity\Article::class)->find($id);
        $articleSoap = new ArticleSoap($article->getId(), $article->getLibelle(), $article->getTexte(), $article->getVisuel(), $article->getPrix());
        return $articleSoap;
    }

    // /**
    //  * Retourne tous les articles
    //  * @param int $id
    //  * @return \App\Soap\ArticleSoap Le secteur avec l'id et le libellé
    //  */
    // public function getAllArticles()
    // {
    //     $articles = $this->doct->getRepository(\App\Entity\Article::class)->findAll();

    //     $articlesSoap = [];
    //     foreach ($articles as $article) {
    //         array_push(new ArticleSoap($article->getId(), $article->getLibelle(), $article->getTexte(), $article->getVisuel(), $article->getPrix(), $article->getCategorie()));
    //     }
    //     return $articlesSoap;
    // }

    /**
     * retourne tous les articles d'une catégorie donnée
     * @param int $id
     * @return \App\Soap\CategorieSoap Le secteur avec l'id et le libellé
     */
    public function getCategorieByArticleId($id)
    {
        $article = $this->doct->getRepository(\App\Entity\Article::class)->find($id);
        $categorie = $article->getCategorie();
        $categorieSoap = new CategorieSoap($categorie->getId(), $categorie->getLibelle(), $categorie->getVisuel(), $categorie->getTexte());

        return $categorieSoap;
    }
 }
