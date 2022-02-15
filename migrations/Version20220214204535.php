<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214204535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_genre DROP FOREIGN KEY FK_8D92268116A2B381');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897C83F1AF1');
        $this->addSql('DROP INDEX UNIQ_226E5897C83F1AF1 ON borrowing');
        $this->addSql('ALTER TABLE borrowing CHANGE id_book id_book_id INT NOT NULL');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_226E5897C83F1AF1 ON borrowing (id_book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_genre DROP FOREIGN KEY FK_8D92268116A2B381');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897C83F1AF1');
        $this->addSql('DROP INDEX UNIQ_226E5897C83F1AF1 ON borrowing');
        $this->addSql('ALTER TABLE borrowing CHANGE id_book_id id_book INT NOT NULL');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897C83F1AF1 FOREIGN KEY (id_book) REFERENCES book (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_226E5897C83F1AF1 ON borrowing (id_book)');
    }
}
