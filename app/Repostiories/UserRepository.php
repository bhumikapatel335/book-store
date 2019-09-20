<?php

namespace App\Repostiories;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {


    public function getUser($id)
    {
        return $this->find($id);
    }

    public function save($user , $request)
    {
        $user->setFirstName($request->get('firstName'));
        $user->setLastName($request->get('lastName'));
        $user->setMobileNo($request->get('mobileNo'));
        $user->setEmail($request->get('email'));

        return $user;

    }

    public function getUserByName($name)
    {
        return $this->findBy(['firstName'=> $name ]);
    }

}