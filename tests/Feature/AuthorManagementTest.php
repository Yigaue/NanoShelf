<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_book_author_can_be_created()
    {

        $this->post('/author', [
            'name' => 'author name',
            'dob' => '12/02/1871',
        ]);
            $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1871/02/12', $author->first()->dob->format('Y/d/m'));
    }
}
