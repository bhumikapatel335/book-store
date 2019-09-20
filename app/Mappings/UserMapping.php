<?php

namespace App\Mappings;



use App\Entities\User;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class UserMapping extends EntityMapping
{

    public function mapFor()
    {
        return User::class;
    }


    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {

        $builder->increments('id');
        $builder->string('firstName')->nullable();
        $builder->string('lastName')->nullable();
        $builder->bigInteger('mobileNo')->nullable();
        $builder->string('email')->nullable();


    }

}