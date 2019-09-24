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
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword(encrypt($request->get('password')));
        $user->setMobileNo($request->get('mobileNo'));

        return $user;

    }

    public function getUserByName($name)
    {
        return $this->findBy(['username'=> $name ]);
    }

}