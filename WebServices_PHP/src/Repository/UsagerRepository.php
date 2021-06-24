<?php

namespace App\Repository;

use App\Entity\Usager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Usager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usager[]    findAll()
 * @method Usager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsagerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usager::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Usager) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    //Retourne toutes les commandes de l'utilisateur
    public function getAllCommandes(UserInterface $user) : array {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'Select c
             FROM App\Entity\Commande c
             WHERE c.usager =:user'
        )->setParameter('user', $user);

        return $query->getArrayResult();

    }

    // /**
    //  * @return Usager[] Returns an array of Usager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usager
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
