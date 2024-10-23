<?php 

namespace App\Test;

use App\Entity\Offer;
use PHPUnit\Framework\TestCase;
use App\Entity\Ticket;
use App\Entity\User;

class EntityTicketTest extends TestCase{
    public function testGetterSetter(){
        $ticket = new Ticket();
        $createAt = new \DateTimeImmutable('2024-10-19 17:00:00');
        $updateAt = new \DateTimeImmutable('2024-10-19 18:00:00');
        $user = new User();
        $offer = new Offer();


        $ticket->setPrice(21)
            ->setQuantity(2)
            ->setPlan('deux')
            ->setQrcode('test')
            ->setUser($user)
            ->setCreatedAt($createAt)
            ->setUpdatedAt($updateAt)
            ->setOffer($offer);

        $this->assertEmpty($ticket->getId());
        $this->assertEquals(21, $ticket->getPrice());
        $this->assertEquals(2, $ticket->getQuantity());
        $this->assertEquals('deux', $ticket->getPlan());
        $this->assertEquals('test', $ticket->getQrcode());
        $this->assertEquals($user, $ticket->getUser());
        $this->assertEquals($createAt, $ticket->getCreatedAt());
        $this->assertEquals($updateAt, $ticket->getUpdatedAt());
        $this->assertEquals($offer, $ticket->getOffer());
    }
    public function testCreatedAtAndUpdatedAt()
    {
        $ticket = new Ticket();
        $now = new \DateTimeImmutable();
    
        $this->assertInstanceOf(\DateTimeImmutable::class, $ticket->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $ticket->getUpdatedAt());
        $this->assertLessThan(1, $now->getTimestamp() - $ticket->getCreatedAt()->getTimestamp());
        $this->assertLessThan(1, $now->getTimestamp() - $ticket->getUpdatedAt()->getTimestamp());
    
        $newUpdate = new \DateTimeImmutable('2024-12-31');
        $ticket->setUpdatedAt($newUpdate);
        $this->assertEquals($newUpdate, $ticket->getUpdatedAt());
    }

}