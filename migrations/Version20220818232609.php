<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818232609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand_segment_group (brand_id INT NOT NULL, segment_group_id INT NOT NULL, PRIMARY KEY(brand_id, segment_group_id))');
        $this->addSql('CREATE INDEX IDX_2A609E6A44F5D008 ON brand_segment_group (brand_id)');
        $this->addSql('CREATE INDEX IDX_2A609E6AB00F2352 ON brand_segment_group (segment_group_id)');
        $this->addSql('ALTER TABLE brand_segment_group ADD CONSTRAINT FK_2A609E6A44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE brand_segment_group ADD CONSTRAINT FK_2A609E6AB00F2352 FOREIGN KEY (segment_group_id) REFERENCES segment_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE brand_segment_group');
    }
}
