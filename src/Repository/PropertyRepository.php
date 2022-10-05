<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * Undocumented variable
     *
     * @var $paginator
     */
    private $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Property::class);
        $this->paginator = $paginator;
    }

    public function paginateAllVisibleQuery(PropertySearch $search, int $page)
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice()) {
            $query = $query
                //andWhere traite une à une les requêtes
                // p.prix<=:maxprice signifie que le prix de notre bien soit inferieur au prix données
                ->andwhere('p.prix<=:maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        if ($search->getMinSurface()) {
            $query = $query
                ->andwhere('p.surface>= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }
        if ($search->getOptions() != null) {
            if ($search->getOptions()->count() > 0) {
                $k = 0;
                foreach ($search->getOptions() as $option) {
                    $k++;
                    $query = $query
                        ->andwhere(":option$k  MEMBER OF p.options")
                        ->setParameter("option$k", $option);
                }
            }
        }
        $properties = $this->paginator->paginate(
            $query->getQuery(), //// Requête contenant les données à paginer (ici nos properties)
            $page, //// Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12
        );
        //  $pictures = $this->findForProperties($properties->getItems());
        return $properties;
    }

    /**
     * @param Property[] $properties
     * cette function permet de recuperer l'ensemble des images
     *
     */
    /**
     * @return  Property[]
     * les 4 derniers biens
     *
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * cette function permet de génerer la requete pour tous les enrégistrements visible et aficher les biens qui ont un sold à false
     *
     * @return QueryBuilder
     */
    private function findVisibleQuery(): ORMQueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold=false');
    }
    /* public function findForProperties(array $properties)
    {
        $pictures = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id IN ( :properties)')
            ->groupBy('p.id')
            ->getQuery()
            ->setParameter('properties', $properties)
            ->getResult();
            $pictures=array_reduce($pictures,function (array $acc))
        return $pictures;
    }*/

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
