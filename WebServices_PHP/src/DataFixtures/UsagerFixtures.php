<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Usager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsagerFixtures extends Fixture implements DependentFixtureInterface
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $usager = new Usager();
        $usager->setEmail("admin@gmail.com");
        $usager->setRoles(array('ROLE_ADMIN'));
        $usager->setPassword($this->encoder->encodePassword($usager, 'admin'));
        $usager->setNom('Jose');
        $usager->setPrenom('DeLaCompta');
        $manager->persist($usager);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class,
        ];
    }

}