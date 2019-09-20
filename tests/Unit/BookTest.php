<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{

    public function testBookGetByAuthorCorrectly()
    {
        $response = $this->json('GET', '/api/v1/book/search/author/Robin Nixon');
        $response
            ->assertStatus(200);
    }

    public function testBookGetByCategoryCorrectly()
    {
        $response = $this->json('GET', '/api/v1/book/search/category/Linux');
        $response
            ->assertStatus(200);
    }


    public function testBookGetByAuthorAndCategoryCorrectly()
    {
        $response = $this->json('GET', '/api/v1/book/search/author/Robin Nixon/category/Linux');
        $response
            ->assertStatus(200);
    }


    public function testBookCreatedCorrectly()
    {
        $response = $this->json('POST', '/api/v1/book/create',[
            'isbn' => '978-1491918221',
            'title' => 'Learning PHP, MySQL & JavaScript: With jQuery ',
            'author' => 'Bhumika Patel',
            'category' => 'PHP, Javascript',
            'price' => '10.2 GBP'
        ]);

        $response
            ->assertStatus(201);

    }

    public function testBookUpdatedCorrectly()
    {
        $response = $this->json('PUT', '/api/v1/book/1',[
            'isbn' => '978-1434567892',
            'title' => 'Learning PHP & JavaScript: With jQuery ',
            'author' => 'Bhumika Patel',
            'category' => 'PHP, Javascript',
            'price' => '10.2 GBP'
        ]);

        $response
            ->assertStatus(200);

    }


    public function testBookDeletedCorrectly()
    {
        $response = $this->json('DELETE', '/api/v1/book/8');
        $response
            ->assertStatus(200);
    }

    public function testGetAllCategoryCorrectly()
    {
        $response = $this->json('GET', '/api/v1/book/categories');
        $response
            ->assertStatus(200);
    }

    public function testBookCreatedWithInvalidNumber()
    {
        $response = $this->json('POST', '/api/v1/book/create',[
            'isbn' => '978-INVALID-ISBN-1491905012',
            'title' => 'Learning PHP, MySQL & JavaScript: With jQuery ',
            'author' => 'Bhumika Patel',
            'category' => 'PHP, Javascript',
            'price' => '10.2 GBP'
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                "message" => "Invalid ISBN"
            ]);
    }













}
