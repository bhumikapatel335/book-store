<?php

namespace App\Http\Controllers;

use App\Repostiories\BookRepository;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use App\Entities\Book;
use PhpParser\Node\Expr\Cast\Object_;

class BookController extends Controller
{
    protected $em;
    protected $bookRepository;

    public function __construct(EntityManager $em, BookRepository $bookRepository)
    {
        $this->em = $em;
        $this->bookRepository = $bookRepository;

    }


    //add new book
    public function create(Request $request)
    {
        $book = new Book();

        $isbn = explode("-", $request->get('isbn'));
        $isValid = count($isbn) == 2 && is_numeric($isbn[0]) && is_numeric($isbn[1]) && $isbn[0] == '978' && strlen($isbn[1]) == 10;
        if ($isValid)
        {
            //$book = Book::create($request->all());
            $book->setIsbn($request->get('isbn'));
            $book->setTitle($request->get('title'));
            $book->setAuthor($request->get('author'));
            $book->setCategory($request->get('category'));
            $book->setPrice($request->get('price'));

            // save information
            $this->em->persist($book);
            $this->em->flush();

            return response()->json($book, 201);
        }
        return response()->json(["message" => "Invalid ISBN"], 400);
    }

    //search book by author name and category
    public function searchByAuthorAndCategory($author, $category)
    {
        $books = Book::where('author', '=', $author)
            ->where('category', '=', $category)
            ->get('isbn');
        return response()->json($books, 200);
    }

    //search book by author name
    public function searchByAuthor($author)
    {
//        $books = Book::where('author', '=', $author)
//            ->get('isbn');

        $books = $this->bookRepository->findByName( $author);

        dump($books);


        /** @var Book $book */

        foreach($books as $book) {
            $isbn = $book->getIsbn();
        }
        return response()->json($isbn, 200);
    }

    //search book by category
    public function searchByCategory($category)
    {
//        $categories = Book::where('category', 'like', '%'.$category.'%')
//            ->get('isbn');
//        return response()->json($categories, 200);

        $books = $this->bookRepository->findByCategory( $category);

        /** @var Book $book */
        foreach($books as $book) {
            $isbn = $book->getIsbn();
        }
        return response()->json($isbn, 200);
    }

    //list all unique book categories
    public function showCategories()
    {
        //get all categories assigned to books
        $categories = Book::select('category')
            ->from('books')
            ->groupBy('category')
            ->get('category');

        //convert categories to array
        $decodedCategories = json_decode($categories, true);

        /*find all possible categories.
        * It is required as one book can have multiple categories assigned as comma separated value.
        * This may include duplicates.*/
        $allCategories = array();
        for ($i = 0; $i < count($decodedCategories); $i++) {

            //split comma separated categories assigned to a book
            $tempCategories = reset($decodedCategories[$i]);
            $categoryList = explode(",", $tempCategories);

            for ($j = 0; $j < count($categoryList); $j++) {
                array_push($allCategories, array('category' => trim($categoryList[$j])));
            }
        }

        //find unique categories
        $uniqCategories = array_unique($allCategories, SORT_REGULAR);

        return response()->json($uniqCategories, 200);

    }

    //delete book by book id
    public function delete($id)
    {
        // $book->delete();

        $book = $this->em->find('App\Entities\Book',$id);



        $this->em->remove($book);
        $this->em->flush();

        return response()->json($book, 200);

    }

    //update book details by book id
    public function update(Request $request,$id)
    {

        $isbn = explode("-", $request->get('isbn'));
        $isValid = count($isbn) == 2 && is_numeric($isbn[0]) && is_numeric($isbn[1]) && $isbn[0] == '978' && strlen($isbn[1]) == 10;
        if ($isValid) {

           // $book->update($request->all());

            $book = $this->em->find('App\Entities\Book',$id);

            $book->setIsbn($request->get('isbn'));
            $book->setTitle($request->get('title'));
            $book->setAuthor($request->get('author'));
            $book->setCategory($request->get('category'));
            $book->setPrice($request->get('price'));

            // save information
            $this->em->persist($book);
            $this->em->flush();


            return response()->json($book, 200);
        }
        return response()->json(["message" => "Invalid ISBN"], 400);
    }

}
