<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
   public function store()
   {
      //$this-> validateRequest();

       Book::create($this-> validateRequest());
       
    //Book::create(request(['title', 'author']));
   }

    public function update(Book $book)
    {

            $book->update( $this->validateRequest());
    }

    protected function validateRequest()
    {

    return $this->validate(request(), [

            'title' => 'required',
            'author' => 'required',
        ]);

    }
}
