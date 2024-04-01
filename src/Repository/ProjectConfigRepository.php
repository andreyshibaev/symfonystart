<?php

namespace App\Repository;

use App\Entity\ProjectConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectConfig>
 *
 * @method ProjectConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectConfig[]    findAll()
 * @method ProjectConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectConfig::class);
    }

    //    /**
    //     * @return ProjectConfig[] Returns an array of ProjectConfig objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProjectConfig
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
