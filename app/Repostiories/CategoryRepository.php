<?php


namespace App\Repostiories;


use App\Entities\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository {

    public function findByName($category)
    {
        return $this->findOneBy(['name'=> $category]);
    }

    public function findAllCategory()
    {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('c.name')
            ->from(Category::class, 'c');

        return $qb->getQuery()->getResult();

    }


}