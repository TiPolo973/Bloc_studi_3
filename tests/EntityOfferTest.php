<?php 

namespace App\Test;

use PHPUnit\Framework\TestCase;
use App\Entity\Offer;
use App\Entity\Ticket;

class EntityOfferTest extends TestCase{

    // public function testAreWorking(){
    //     $this->assertEquals(2, 1+1);
    // }

    public function testGetterSetterEntityOffer(){
       $offer = new Offer();
       $dateTime = new \DateTime('2024-10-19 14:00:00');
       $createAt = new \DateTimeImmutable('2024-10-19 15:00:00');
       $updateAt = new \DateTimeImmutable('2024-10-19 16:00:00');
       $ticket = new Ticket();

       $this->assertNull($offer->getId(), 'id doit null avant la persistance');

       $offer->setLocation('Cayenne');
       $this->assertEquals('Cayenne', $offer->getLocation());

       $offer->setTitle('Whycella');
       $this->assertEquals('Whycella', $offer->getTitle());

       $offer->setDateTime($dateTime);
       $this->assertEquals($dateTime, $offer->getDateTime());

       $offer->setCreatedAt($createAt);
       $this->assertEquals($createAt, $offer->getCreatedAt());

       $offer->setUpdatedAt($updateAt);
       $this->assertEquals($updateAt, $offer->getUpdatedAt());

       $offer->setDescription('Une description');
       $this->assertEquals('Une description', $offer->getDescription());

       $offer->addTicket($ticket);
       $this->assertCount(1, $offer->getTickets());
       $this->assertTrue($offer->getTickets()->contains($ticket));

       $offer->removeTicket($ticket);
       $this->assertCount(0, $offer->getTickets());
       $this->assertFalse($offer->getTickets()->contains($ticket));
    }

    public function testCreatedAtAndUpdatedAt()
{
    $offer = new Offer();
    $now = new \DateTimeImmutable();

    $this->assertInstanceOf(\DateTimeImmutable::class, $offer->getCreatedAt());
    $this->assertInstanceOf(\DateTimeImmutable::class, $offer->getUpdatedAt());
    $this->assertLessThan(1, $now->getTimestamp() - $offer->getCreatedAt()->getTimestamp());
    $this->assertLessThan(1, $now->getTimestamp() - $offer->getUpdatedAt()->getTimestamp());

    $newUpdate = new \DateTimeImmutable('2024-12-31');
    $offer->setUpdatedAt($newUpdate);
    $this->assertEquals($newUpdate, $offer->getUpdatedAt());
}

}