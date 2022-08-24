<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818233557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE model_segment_group (model_id INT NOT NULL, segment_group_id INT NOT NULL, PRIMARY KEY(model_id, segment_group_id))');
        $this->addSql('CREATE INDEX IDX_D50B90E17975B7E7 ON model_segment_group (model_id)');
        $this->addSql('CREATE INDEX IDX_D50B90E1B00F2352 ON model_segment_group (segment_group_id)');
        $this->addSql('ALTER TABLE model_segment_group ADD CONSTRAINT FK_D50B90E17975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE model_segment_group ADD CONSTRAINT FK_D50B90E1B00F2352 FOREIGN KEY (segment_group_id) REFERENCES segment_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE model_segment_group');
    }
}
