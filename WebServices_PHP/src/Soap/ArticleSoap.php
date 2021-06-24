<?php

namespace App\Soap;

use App\Soap\CategorieSoap;

/**
 * Class ArticleSoap
 * @package App\Soap
 */
class ArticleSoap
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
     * @var int $prix
     */
    public $prix;

    /**
     * @var CategorieSoap $categorie
     */
    public $categorie;


    /**
     * ArticleSoap constructor.
     * @param int $id
     * @param string $libelle
     * @param string $texte
     * @param string $visuel
     * @param int $prix
     * @param CategorieSoap $categorie
     */
    public function __construct(
        int $id,
        string $libelle,
        string $texte,
        string $visuel,
        int $prix,
        CategorieSoap $categorie
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->texte = $texte;
        $this->visuel = $visuel;
        $this->prix = $prix;
        $this->categorie = $categorie;
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
     * @return int
     */
    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    /**
     * @param int $Prix
     */
    public function setPrix(int $Prix): void
    {
        $this->Prix = $Prix;
    }

    /**
     * @return CategorieSoap
     */
    public function getCategorie(): ?CategorieSoap
    {
        return $this->categorie;
    }

    /**
     * @param CategorieSoap $categorie
     */
    public function setCategorie(CategorieSoap $categorie): void
    {
        $this->categorie = $categorie;
    }
}
