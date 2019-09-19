<?php

namespace App\Entities;



use Doctrine\Common\Collections\ArrayCollection;

class Book
{
    /** @var  */
    protected $id;

    /** @var string */
    protected $isbn;

    /** @var string */
    protected $title;

    /** @var string */
    protected $author;

    /** @var  string */
    protected $price;

    /** @var ArrayCollection  */
    public $categories;



    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function addCategory(Category $category){

        if( ! $this->categories->contains($category))
        {
            $this->categories->add($category);

            $category->addBook($this);
        }

    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories)
    {
        $this->categories[] = $categories;
    }




    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }


public function resetCategory() {
        $this->categories->clear();
}

}