<?php

namespace Tests\Feature;

use App\Author;
use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()

    {

        $response = $this->post('/books', $this->data());

        $book = Book::first();

        $this->assertCount(1, Book::all());

        $response->assertRedirect();
    }

    /** @test */

    public function a_book_title_is_required()

    {

        //$this->withoutExceptionHandling();

       $response = $this->post('/books', [

            'title' => '',
            'author' => 'Jimmy',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */

    public function a_book_author_is_required()
    {
        $response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));
       

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */

    public function a_book_can_be_updated()
    {

        $this->post('/books', $this->data());

                $book = Book::first();

        $response = $this->patch($book->path(), [

            'title' => 'New Title',
            'author_id' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);
        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */

    public function a_book_can_be_deleted()
    {

            $this->post('/books', $this->data());

            $this->assertCount(1, Book::all());

            $book = Book::first();

            $response = $this->delete('/books/'. $book->id);
            $this->assertCount(0, Book::all());
            $response->assertRedirect('/books');

    }

    // Since we are hitting the '/books' endpoint, this test is herre
    /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', $this->data());

        $book = Book::first();
        $author = Author::first();


        $this->assertEquals($author->id, $book->author_id);

        $this->assertCount(1, Author::all());
    }

    public function data()
    {
        return  ['title' => 'Cool book Title',
            'author_id' => 'Jimmy',
    ];

    }

}
