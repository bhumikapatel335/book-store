<?php

namespace App\Mappings;

use App\Entities\Book;
use App\Entities\Category;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class BookMapping extends EntityMapping
{

    public function mapFor()
    {
        return Book::class;
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {

        $builder->increments('id');
        $builder->string('isbn')->nullable();
        $builder->string('title')->nullable();
        $builder->string('author')->nullable();
        $builder->string('price')->nullable();

        $builder->hasMany(Category::class)->mappedBy('$book');


    }

}