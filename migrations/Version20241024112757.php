<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024112757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Modifier le nom de la colonne de 'key' à 'user_key'
        $this->addSql('ALTER TABLE ticket ADD user_key VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD user_key VARCHAR(255) NOT NULL');
    }
    
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ticket DROP user_key');
        $this->addSql('ALTER TABLE user DROP user_key');
    }
}    
