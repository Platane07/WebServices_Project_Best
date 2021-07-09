<?php

namespace App\Soap;

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
     * ArticleSoap constructor.
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
        string $visuel,
        int $prix
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->texte = $texte;
        $this->visuel = $visuel;
        $this->prix = $prix;
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
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
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
}
