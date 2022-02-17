<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216203015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33176404F3C');
        $this->addSql('DROP INDEX IDX_CBE5A33176404F3C ON book');
        $this->addSql('ALTER TABLE book DROP id_author_id, CHANGE genre_id genre_id INT NOT NULL');
        $this->addSql('ALTER TABLE genre DROP name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD id_author_id INT NOT NULL, CHANGE genre_id genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33176404F3C FOREIGN KEY (id_author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33176404F3C ON book (id_author_id)');
        $this->addSql('ALTER TABLE genre ADD name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
