<?php

namespace App\Repostiories;


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




}