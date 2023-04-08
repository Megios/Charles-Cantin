<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230408082208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_categorie DROP FOREIGN KEY FK_44838015504EE252');
        $this->addSql('ALTER TABLE photo_categorie ADD CONSTRAINT FK_44838015504EE252 FOREIGN KEY (photo_uuid) REFERENCES photo (uuid) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_categorie DROP FOREIGN KEY FK_44838015504EE252');
        $this->addSql('ALTER TABLE photo_categorie ADD CONSTRAINT FK_44838015504EE252 FOREIGN KEY (photo_uuid) REFERENCES photo (uuid)');
    }
}
