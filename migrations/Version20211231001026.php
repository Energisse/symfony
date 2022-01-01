<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211231001026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C936999BD12CF');
        $this->addSql('DROP INDEX IDX_C27C936999BD12CF ON stage');
        $this->addSql('ALTER TABLE stage CHANGE code_entreprise_id entreprise_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93699F3E4DA4 FOREIGN KEY (entreprise_code_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_C27C93699F3E4DA4 ON stage (entreprise_code_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93699F3E4DA4');
        $this->addSql('DROP INDEX IDX_C27C93699F3E4DA4 ON stage');
        $this->addSql('ALTER TABLE stage CHANGE entreprise_code_id code_entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C936999BD12CF FOREIGN KEY (code_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_C27C936999BD12CF ON stage (code_entreprise_id)');
    }
}
