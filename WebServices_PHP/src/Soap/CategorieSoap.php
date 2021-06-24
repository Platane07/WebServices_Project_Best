<?php

namespace App\Soap;

use App\Soap\ArticleSoap;

/**
 * Class CategorieSoap
 * @package App\Soap
 */
class CategorieSoap
{
    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $libelle
     */
    public $libelle;

    /**
     * @var string $texte
     */
    public $texte;

    /**
     * @var string $visuel
     */
    public $visuel;

    /**
     * @var ArticleSoap[] $articles
     */
    public $articles;


    /**
     * CategorieSoap constructor.
     * @param int $id
     * @param string $libelle
     * @param string $texte
     * @param string $visuel
     * @param int $prix
     */
    public function __construct(
        int $id,
        string $libelle,
        string $texte,
        string $visuel
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->texte = $texte;
        $this->visuel = $visuel;
        $this->articles = [];
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    /**
     * @param string $Libelle
     */
    public function setLibelle(string $Libelle): void
    {
        $this->Libelle = $Libelle;
    }

    /**
     * @return string
     */
    public function getTexte(): ?string
    {
        return $this->Texte;
    }

    /**
     * @param string $Texte
     */
    public function setTexte(string $Texte): void
    {
        $this->Texte = $Texte;
    }

    /**
     * @return string
     */
    public function getVisuel(): ?string
    {
        return $this->Visuel;
    }

    /**
     * @param string $Visuel
     */
    public function setVisuel(string $Visuel): void
    {
        $this->Visuel = $Visuel;
    }

    /**
     * @return ArticleSoap[]
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @param ArticleSoap $article
     */
    public function addArticle(ArticleSoap $article): void
    {
        array_push($this->articles, $article);
    }
}
