<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
   public function store()
   {
      //$this-> validateRequest();

       $book = Book::create($this-> validateRequest());

    //Book::create(request(['title', 'author']));

        return redirect($book->path());

   }

    public function update(Book $book)
    {
        $book->update( $this->validateRequest());

        return redirect($book->path());
    }

    public function destroy(Book $book)
    {
            $book->delete();

            return redirect('/books');
    }

    protected function validateRequest()
    {

         return $this->validate(request(), [

            'title' => 'required',
            'author_id' => 'required',
        ]);

    }


}
