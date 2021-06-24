<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\LigneCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneCommande[]    findAll()
 * @method LigneCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneCommande::class);
    }

    //Fonction qui récupère les articles les plus vendus
    public function getMostSoldArticles() : array {

        $entityManager = $this->getEntityManager();

        $query =  $entityManager->createQueryBuilder('l')
            ->select('a.libelle, a.visuel, SUM(l.quantite) as total')
            ->from('App\Entity\LigneCommande', 'l')
            ->leftJoin('l.article','a')
            ->groupBy('l.article')
            ->orderBy('total', 'DESC')
            ->setMaxResults(4);

        return $query->getQuery()->getArrayResult();
    }
}
