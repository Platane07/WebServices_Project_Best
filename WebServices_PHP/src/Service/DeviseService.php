<?php

// src/Service/PanierService.php
namespace App\Service;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Usager;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
use App\Service\BoutiqueService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;


class DeviseService extends EntityRepository{

    private $session;

    public function __construct(SessionInterface $session){

        $this->session = $session;

    }

    public function convert($somme){
        $client = HttpClient::create();

        if ($this->session->get('devise')) {
            $devise = $this->session->get('devise');
        } else {
            $devise = 'EUR';
            $this->session->set('devise', $devise);
        }

        $change = $client->request("GET", "https://api.exchangeratesapi.io/latest")->toArray();

        if ($devise == 'EUR') {
            return $somme;
        }

        $conversion = $somme * $change["rates"][$devise];

        return $conversion;

    }

    public function setDevise($devise) {
        $this->session->set('devise', $devise);
    }
}