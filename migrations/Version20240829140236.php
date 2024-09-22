<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240829140236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E8FDC0E9A');
        $this->addSql('DROP INDEX IDX_29D6873E8FDC0E9A ON offer');
        $this->addSql('ALTER TABLE offer DROP tickets_id');
        $this->addSql('ALTER TABLE ticket ADD offer_id_id INT DEFAULT NULL, CHANGE user_id_id user_id_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3FC69E3BE FOREIGN KEY (offer_id_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3FC69E3BE ON ticket (offer_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD tickets_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E8FDC0E9A FOREIGN KEY (tickets_id) REFERENCES ticket (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29D6873E8FDC0E9A ON offer (tickets_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3FC69E3BE');
        $this->addSql('DROP INDEX IDX_97A0ADA3FC69E3BE ON ticket');
        $this->addSql('ALTER TABLE ticket DROP offer_id_id, CHANGE user_id_id user_id_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }
}
