<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115124851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing ADD id_book_id INT NOT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E589779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_226E5897C83F1AF1 ON borrowing (id_book_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_226E589779F37AE5 ON borrowing (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897C83F1AF1');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E589779F37AE5');
        $this->addSql('DROP INDEX UNIQ_226E5897C83F1AF1 ON borrowing');
        $this->addSql('DROP INDEX UNIQ_226E589779F37AE5 ON borrowing');
        $this->addSql('ALTER TABLE borrowing DROP id_book_id, DROP id_user_id');
    }
}
