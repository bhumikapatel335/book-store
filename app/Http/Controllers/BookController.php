<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Repostiories\BookRepository;
use App\Repostiories\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use App\Entities\Book;
use PHPUnit\Runner\Exception;

class BookController extends Controller
{
    protected $em;
    protected $bookRepository;
    protected $categoryRepository;

    public function __construct(EntityManager $em, BookRepository $bookRepository, CategoryRepository  $categoryRepository)
    {
        $this->em = $em;
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;

    }


    //add new book
    public function create(Request $request)
    {


        $isbn = explode("-", $request->get('isbn'));
        $isValid = count($isbn) == 2 && is_numeric($isbn[0]) && is_numeric($isbn[1]) && $isbn[0] == '978' && strlen($isbn[1]) == 10;

        if ($isValid)
        {
            $book = new Book();

            $book->setIsbn($request->get('isbn'));
            $book->setTitle($request->get('title'));
            $book->setAuthor($request->get('author'));
            $book->setPrice($request->get('price'));

            //separate category name with ',' separator
            $category = explode(",",$request->get('category'));

            foreach ($category as $categoryName)
            {

                $category = $this->categoryRepository->findByName( trim($categoryName));



                if (!$category){

                    $category = new Category();

                    $category->setName(trim($categoryName));

                    $this->em->persist($category);
                    $this->em->flush();
                }

                $book->addCategory($category);

            }

            // save information

            $this->em->persist($book);
            $this->em->flush();

            return response()->json('saved new book with book id: '.$book->getId(), 201);
        }
        return response()->json(["message" => "Invalid ISBN"], 400);
    }

    //search book by author name and category
    public function searchByAuthorAndCategory($author, $category)
    {
        $books = $this->bookRepository->getBookByAuthorAndCategory($author,$category);

        /** @var Book $book*/
        foreach($books as $book){
            $isbn[] =$book->getIsbn();
        }


        return response()->json($isbn, 200);
    }

    //search book by author name
    public function searchByAuthor($author)
    {
        $books = $this->bookRepository->getBookByAuthor($author);

        /** @var Book $book*/
        foreach($books as $book){
            $isbn[] = $book->getIsbn();
        }

        return response()->json( $isbn, 200);
    }

    //search book by category
    public function searchByCategory($category)
    {
        $books = $this->bookRepository->getBookByCategory($category);

        /** @var Book $book*/
        foreach($books as $book){
            $isbn[] =$book->getIsbn();
        }

        return response()->json($isbn, 200);
    }

    //list all unique book categories
    public function showCategories()
    {
        $categories = $this->categoryRepository->findAllCategory();

        $categoryList = array();

        foreach($categories as $category)
        {
          $categoryList[] = $category["name"];
        }


        return response()->json($categoryList, 200);



    }

    //delete book by book id
    public function delete($id)
    {

        $book = $this->em->find('App\Entities\Book',$id);

        if($book)
        {
            $this->em->remove($book);

            $this->em->flush();

            return response()->json('book deleted successfully', 200);
        }
        else
        {
           throw  new Exception('Book not found');
        }


    }

    //update book details by book id
    public function update(Request $request,$id)
    {

        $isbn = explode("-", $request->get('isbn'));

        $isValid = count($isbn) == 2 && is_numeric($isbn[0]) && is_numeric($isbn[1]) && $isbn[0] == '978' && strlen($isbn[1]) == 10;
        if ($isValid)
        {

            $book = $this->em->find('App\Entities\Book',$id);

            $book->setIsbn($request->get('isbn'));
            $book->setTitle($request->get('title'));
            $book->setAuthor($request->get('author'));
            $book->setPrice($request->get('price'));


            $category = explode(",",$request->get('category'));

            $book->resetCategory();
            foreach ($category as $categoryName)
            {

                $category = $this->categoryRepository->findByName( trim($categoryName));

                if (!$category){

                    $category->setName(trim($categoryName));

                    $this->em->persist($category);
                    $this->em->flush();
                }

                $book->addCategory($category);

            }

            // save information

            $this->em->persist($book);
            $this->em->flush();

            return response()->json($book, 200);
        }
        return response()->json(["message" => "Invalid ISBN"], 400);
    }

}
