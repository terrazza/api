<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818231413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP CONSTRAINT fk_d79572d944f5d008');
        $this->addSql('DROP INDEX idx_d79572d944f5d008');
        $this->addSql('ALTER TABLE model ALTER brand_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE model ALTER brand_id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE model ALTER brand_id TYPE INT');
        $this->addSql('ALTER TABLE model ALTER brand_id DROP DEFAULT');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT fk_d79572d944f5d008 FOREIGN KEY (brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d79572d944f5d008 ON model (brand_id)');
    }
}
