<?php

namespace App\Mappings;


use App\Entities\Book;
use App\Entities\Category;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class CategoryMapping extends EntityMapping
{

    public function mapFor()
    {
        return Category::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {

        $builder->increments('id');

        $builder->string('name')->nullable();

        $builder->belongsTo(Book::class)->inversedBy('categories');

    }


}