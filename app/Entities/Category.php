<?php


namespace App\Entities;


use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    /** @var  */
    protected $id;

    /** @var string */
    protected $name;

    /** @var ArrayCollection  */
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function addBook(Book $book){

        if( ! $this->books->contains($book))
        {
            $this->books->add($book);
            $book->addCategory($this);
        }

    }


    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param mixed $books
     */
    public function setBooks($books)
    {
        $this->books = $books;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

}