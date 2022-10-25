<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Auteur;
use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
        
    }
       /**
    * @return Book[] Returns an array of Book objects
    */
    public function findByKeyword(string $keyword): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.title LIKE :keyword')
            ->setParameter('keyword', "%{$keyword}%")
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
       /**
    * @return Book[] Returns an array of Book objects
    */
   public function findByAuteur(Auteur $auteurId): array
   {
       return $this->createQueryBuilder('b')
           ->join('b.auteur','a')
           ->andWhere('a.id= :auteurId')
           ->setParameter('auteurId', $auteurId->getId())
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByGenre(Genre $genre): array
   {
       return $this->createQueryBuilder('b')
       ->join("b.genres","g")
           ->andWhere("g.id = :gId")
           ->setParameter('gId', $genre->getId())
           ->orderBy('b.id')
           ->getQuery()
           ->getResult()
           ;
   }
      /**
   * @return Book[] Returns an array of Book objects
   */

      /**
    * @return Book[] Returns an array of Book objects
    */
   public function findByKeywordGenre(string $value): array
   {
       return $this->createQueryBuilder('b')
            ->join("b.genres", "g")
           ->andWhere('g.nom LIKE :val')
           ->setParameter('val', "%{$value}%")
           ->orderBy('b.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }
//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
