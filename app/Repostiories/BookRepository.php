<?php

namespace App\Repostiories;


use App\Entities\Book;
use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository {

    public function findByName($name)
    {
        return $this->findBy(['author'=> $name]);
    }

    public function findByCategory($name)
    {
        return $this->findBy(['category'=> $name]);

    }

    public function getBookByAuthor($name)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('b')
            ->from(Book::class, 'b')
            ->where('b.author like :author')
            ->setParameter('author', $name);

       return $qb->getQuery()->getResult();


    }

    public function getBookByCategory($name)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b')
            ->from(Book::class, 'b')
            ->leftJoin('b.categories', 'c')
            ->where('c.name = :name')
            ->setParameter('name', $name);

        return $qb->getQuery()->getResult();
    }


    public function getBookByAuthorAndCategory($author,$category)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b')
            ->from(Book::class, 'b')
            ->leftJoin('b.categories', 'c')
            ->where('c.name = :category')
            ->andWhere('b.author =:author')
            ->setParameters(['category'=> $category,'author'=>$author]);

        return $qb->getQuery()->getResult();
    }
}