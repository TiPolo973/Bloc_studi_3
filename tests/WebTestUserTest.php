<?php

namespace App\Tests;

use App\Repository\UserRepository;
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
public function testPanier(): void
{
    $client = static::createClient();
    $crawler = $client->request('GET', '/Panier');
    $this->assertResponseIsSuccessful(); 
}
public function testLoginTicket(): void
{
    $client = static::createClient();

    $userRepository = static::getContainer()->get(UserRepository::class);
    $testUser = $userRepository->findOneByEmail('admin@outlook.com');

    $client->loginUser($testUser);

    $crawler = $client->request('GET', '/achat/ticket');
    $this->assertResponseIsSuccessful(); 
}
public function testLoginAdminList(): void
{
    $client = static::createClient();

    $userRepository = static::getContainer()->get(UserRepository::class);
    $testUser = $userRepository->findOneByEmail('admin@outlook.com');

    $client->loginUser($testUser);

    $crawler = $client->request('GET', '/admin/list');
    $this->assertResponseIsSuccessful(); 
}
public function testLoginAdminTicket(): void
{
    $client = static::createClient();

    $userRepository = static::getContainer()->get(UserRepository::class);
    $testUser = $userRepository->findOneByEmail('admin@outlook.com');

    $client->loginUser($testUser);

    $crawler = $client->request('GET', '/admin/ticket');
    $this->assertResponseIsSuccessful(); 
    $crawler = $client->request('GET', '/admin/offer');
    $this->assertResponseIsSuccessful();

}
public function testUserProfil()
{
    $client = static::createClient();

    $userRepository = static::getContainer()->get(UserRepository::class);
    $testUser = $userRepository->findOneByEmail('admin@outlook.com');

    $client->loginUser($testUser);

    $crawler = $client->request('GET', '/');
    $this->assertResponseIsSuccessful();
}
public function testPaiementCancel()
{
    $client = static::createClient();

    $userRepository = static::getContainer()->get(UserRepository::class);
    $testUser = $userRepository->findOneByEmail('admin@outlook.com');

    $client->loginUser($testUser);

    $crawler = $client->request('GET', '/payment/cancel');
    $this->assertResponseIsSuccessful();
    $this->assertSelectorTextContains('h1', 'Paiement annulé !');
}

public function testRedirectToLogin(): void
{
    $client = static::createClient();

    $crawler = $client->request('GET', '/achat/ticket');

    $this->assertResponseRedirects('/login');
}

 
}
