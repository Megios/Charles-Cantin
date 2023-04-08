<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230408080117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_categorie DROP FOREIGN KEY FK_44838015A656D7F1');
        $this->addSql('DROP INDEX IDX_44838015A656D7F1 ON photo_categorie');
        $this->addSql('DROP INDEX `primary` ON photo_categorie');
        $this->addSql('ALTER TABLE photo_categorie CHANGE categorie_uuid photo_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE photo_categorie ADD CONSTRAINT FK_44838015504EE252 FOREIGN KEY (photo_uuid) REFERENCES photo (uuid)');
        $this->addSql('CREATE INDEX IDX_44838015504EE252 ON photo_categorie (photo_uuid)');
        $this->addSql('ALTER TABLE photo_categorie ADD PRIMARY KEY (photo_uuid, categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_categorie DROP FOREIGN KEY FK_44838015504EE252');
        $this->addSql('DROP INDEX IDX_44838015504EE252 ON photo_categorie');
        $this->addSql('DROP INDEX `PRIMARY` ON photo_categorie');
        $this->addSql('ALTER TABLE photo_categorie CHANGE photo_uuid categorie_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE photo_categorie ADD CONSTRAINT FK_44838015A656D7F1 FOREIGN KEY (categorie_uuid) REFERENCES photo (uuid)');
        $this->addSql('CREATE INDEX IDX_44838015A656D7F1 ON photo_categorie (categorie_uuid)');
        $this->addSql('ALTER TABLE photo_categorie ADD PRIMARY KEY (categorie_uuid, categorie_id)');
    }
}
