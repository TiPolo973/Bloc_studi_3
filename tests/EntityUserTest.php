<?php

namespace App\Test;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class EntityUserTest extends TestCase{

    public function testGetterSetter(){
        $user = new User();
        $updateAt = new \DateTimeImmutable('2024-10-19 19:00:00');
        $createAt = new \DateTimeImmutable('2024-10-19 20:00:00');
    
        $user->setEmail('test@test.com')
            ->setRoles(['user'])
            ->setPassword('password123')
            ->setFirstName('firstname')
            ->setLastName('lastname')
            ->setCreatedAt($createAt)
            ->setUpdatedAt($updateAt);
    
        $this->assertNotNull($user->getId()); 
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals(['user', 'ROLE_USER'], $user->getRoles());
        $this->assertEquals('password123', $user->getPassword());
        $this->assertEquals('firstname', $user->getFirstName());
        $this->assertEquals('lastname', $user->getLastName()); 
        $this->assertEquals($createAt, $user->getCreatedAt());
        $this->assertEquals($updateAt, $user->getUpdatedAt());
    }
    public function testCreatedAtAndUpdatedAt()
    {
        $user = new User();
        $now = new \DateTimeImmutable();
    
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getUpdatedAt());
        $this->assertLessThan(1, $now->getTimestamp() - $user->getCreatedAt()->getTimestamp());
        $this->assertLessThan(1, $now->getTimestamp() - $user->getUpdatedAt()->getTimestamp());
    
        $newUpdate = new \DateTimeImmutable('2024-12-31');
        $user->setUpdatedAt($newUpdate);
        $this->assertEquals($newUpdate, $user->getUpdatedAt());
    }
    
}