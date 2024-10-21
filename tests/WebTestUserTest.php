<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebTestUserTest extends WebTestCase
{
    public function testLogin(): void
{
    $client = static::createClient();
    $crawler = $client->request('GET', '/login');
    $this->assertResponseIsSuccessful(); 
    $this->assertSelectorTextContains('h1', 'Please sign in');
}

 
}
