<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912083122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_chambre ADD chambre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_chambre ADD CONSTRAINT FK_A29C5F7A9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_A29C5F7A9B177F54 ON reservation_chambre (chambre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_chambre DROP FOREIGN KEY FK_A29C5F7A9B177F54');
        $this->addSql('DROP INDEX IDX_A29C5F7A9B177F54 ON reservation_chambre');
        $this->addSql('ALTER TABLE reservation_chambre DROP chambre_id');
    }
}
