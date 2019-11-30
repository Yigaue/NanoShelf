<?php

namespace Tests\Unit;

use App\Book;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/

    public function a_book_can_be_added_to_the_library()
    {

      $this->withoutExceptionHandling();

      $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Asigia'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */

    public function a_book_title_is_required()
    {


        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Asigia',

        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_book_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => '',

        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
     public function a_book_can_be_updated()
    {
        $this->WithoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Gospel'
        ]);

        $book = Book::first();
        $response = $this->patch('/books/'.$book->id, [

            'title' => 'New title',
            'author' => 'New author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);

    }


}
