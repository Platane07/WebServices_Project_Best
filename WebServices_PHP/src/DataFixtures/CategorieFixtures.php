<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categorie = new Categorie();
        $categorie->setLibelle("Fruits");
        $categorie->setVisuel("images/fruits.jpg");
        $categorie->setTexte("De la passion ou de ton imagination");
        $this->addReference('1', $categorie);
        $manager->persist($categorie);

        $categorie2 = new Categorie();
        $categorie2->setLibelle("Junk Food");
        $categorie2->setVisuel("images/junk_food.jpg");
        $categorie2->setTexte("Chère et cancérogène, tu es prévenu(e)");
        $this->addReference('2', $categorie2);
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setLibelle("Légumes");
        $categorie3->setVisuel("images/legumes.jpg");
        $categorie3->setTexte("Plus tu en manges, moins tu en es un");
        $this->addReference('3', $categorie3);
        $manager->persist($categorie3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class,
        ];
    }

}
