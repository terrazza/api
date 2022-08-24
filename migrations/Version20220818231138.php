<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818231138 extends AbstractMigration
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
        $this->addSql('ALTER TABLE model RENAME COLUMN brand_id TO brand_id_id');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D924BD5740 FOREIGN KEY (brand_id_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D79572D924BD5740 ON model (brand_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE model DROP CONSTRAINT FK_D79572D924BD5740');
        $this->addSql('DROP INDEX IDX_D79572D924BD5740');
        $this->addSql('ALTER TABLE model RENAME COLUMN brand_id_id TO brand_id');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT fk_d79572d944f5d008 FOREIGN KEY (brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d79572d944f5d008 ON model (brand_id)');
    }
}
