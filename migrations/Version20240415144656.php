<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415144656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote ADD response_id INT DEFAULT NULL, CHANGE vote vote INT NOT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564FBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('CREATE INDEX IDX_5A108564FBF32840 ON vote (response_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564FBF32840');
        $this->addSql('DROP INDEX IDX_5A108564FBF32840 ON vote');
        $this->addSql('ALTER TABLE vote DROP response_id, CHANGE vote vote INT DEFAULT NULL');
    }
}
