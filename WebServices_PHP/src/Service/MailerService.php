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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
use App\Service\BoutiqueService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;


class MailerService extends EntityRepository{

    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, Environment $templating){

        $this->mailer = $mailer;
        $this->templating = $templating;


    }

    public function send($email, $commande){
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('laBoutiqueDuSex@boutiqueDuSex.com')
            ->setTo("xxjolan07xx@gmail.com")
            ->setBody(
                $this->templating->render(
                // templates/emails/registration.html.twig
                    'emails/email.html.twig',
                    ['commande' => $commande]
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}