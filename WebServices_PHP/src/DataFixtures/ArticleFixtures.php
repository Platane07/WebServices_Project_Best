<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setCategorie(
            $this->getReference(1)
        );
        $article->setLibelle("Pomme");
        $article->setTexte("Elle est bonne pour la tienne");
        $article->setVisuel("images/pommes.jpg");
        $article->setPrix(3.42);
        $manager->persist($article);

        $article2 = new Article();
        $article2->setCategorie(
            $this->getReference((1))
        );
        $article2->setLibelle("Poire");
        $article2->setTexte("Ici tu n'en es pas une");
        $article2->setVisuel("images/poires.jpg");
        $article2->setPrix(2.11);
        $manager->persist($article2);

        $article3 = new Article();
        $article3->setCategorie(
            $this->getReference((1))
        );
        $article3->setLibelle("Pêche");
        $article3->setTexte("Elle va te la donner");
        $article3->setVisuel("images/peche.jpg");
        $article3->setPrix(2.84);
        $manager->persist($article3);


        $article4 = new Article();
        $article4->setCategorie(
            $this->getReference((3))
        );
        $article4->setLibelle("Carotte");
        $article4->setTexte("C'est bon pour ta vue");
        $article4->setVisuel("images/carottes.jpg");
        $article4->setPrix(2.90);
        $manager->persist($article4);

        $article5 = new Article();
        $article5->setCategorie(
            $this->getReference((3))
        );
        $article5->setLibelle("Tomate");
        $article5->setTexte("Fruit ou Légume ? Légume");
        $article5->setVisuel("images/tomates.jpg");
        $article5->setPrix(1.70);
        $manager->persist($article5);

        $article6 = new Article();
        $article6->setCategorie(
            $this->getReference((3))
        );
        $article6->setLibelle("Chou Romanesco");
        $article6->setTexte("Mange des fractales");
        $article6->setVisuel("images/romanesco.jpg");
        $article6->setPrix(1.81);
        $manager->persist($article6);

        $article7 = new Article();
        $article7->setCategorie(
            $this->getReference((2))
        );
        $article7->setLibelle("Nutella");
        $article7->setTexte("C'est bon, sauf pour ta santé");
        $article7->setVisuel("images/nutella.jpg");
        $article7->setPrix(4.50);
        $manager->persist($article7);

        $article8 = new Article();
        $article8->setCategorie(
            $this->getReference((2))
        );
        $article8->setLibelle("Pizza");
        $article8->setTexte("Y'a pas pire que za");
        $article8->setVisuel("images/pizza.jpg");
        $article8->setPrix(8.25);
        $manager->persist($article8);

        $article9 = new Article();
        $article9->setCategorie(
            $this->getReference((2))
        );
        $article9->setLibelle("Oreo");
        $article9->setTexte("Seulement si tu es un smartphone");
        $article9->setVisuel("images/oreo.jpg");
        $article9->setPrix(2.50);
        $manager->persist($article9);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,  
        ];
    }

}
