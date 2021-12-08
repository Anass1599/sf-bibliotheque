<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208110657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD gener_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3315D98F7AB FOREIGN KEY (gener_id) REFERENCES gener (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A3315D98F7AB ON book (gener_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3315D98F7AB');
        $this->addSql('DROP INDEX IDX_CBE5A3315D98F7AB ON book');
        $this->addSql('ALTER TABLE book DROP gener_id');
    }
}
