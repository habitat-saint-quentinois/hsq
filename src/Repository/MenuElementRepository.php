<?php

namespace App\Repository;

use App\Entity\MenuElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method MenuElement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuElement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuElement[]    findAll()
 * @method MenuElement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuElementRepository extends ServiceEntityRepository
{
    /**
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MenuElement::class);
    }

    /**
     * @param int $level
     * @return \App\Entity\MenuElement[]
     */
    public function findByLevel(int $level): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.level = :level')
            ->andWhere('m.isActive = 1')
            ->setParameter('level', $level)
            ->orderBy('m.place', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $pageId
     * @return \App\Entity\MenuElement|null
     */
    public function findTopByPage(int $pageId): ?MenuElement
    {
        $element = $this->findOneBy(['page' => $pageId]);
        return $element ? $this->findTopByElement($element) : null;
    }

    /**
     * @param \App\Entity\MenuElement $element
     * @return \App\Entity\MenuElement|null
     */
    public function findTopByElement(MenuElement $element)
    {
        $find = function (MenuElement $element, int $count = 0) use (&$find) {
            ++$count;
            if ($element->getLevel() === 1) {
                return $element;
            } else if ($element->getParent() === null) {
                return null;
            }  else if ($count > 10) {
                return null;
            } else {
                $element = $this->find($element->getParent());
                return $element ? $find($element, $count) : null;
            }
        };
        return $find($element);
    }

//    /**
//     * @return MenuElement[] Returns an array of MenuElement objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MenuElement
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
