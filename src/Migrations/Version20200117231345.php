<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117231345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_spec_definition (category_id INT NOT NULL, spec_definition_id INT NOT NULL, INDEX IDX_5EF8E5DC12469DE2 (category_id), INDEX IDX_5EF8E5DC9FEFA7E7 (spec_definition_id), PRIMARY KEY(category_id, spec_definition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spec_definition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_spec_definition ADD CONSTRAINT FK_5EF8E5DC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_spec_definition ADD CONSTRAINT FK_5EF8E5DC9FEFA7E7 FOREIGN KEY (spec_definition_id) REFERENCES spec_definition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP specs_list');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_spec_definition DROP FOREIGN KEY FK_5EF8E5DC9FEFA7E7');
        $this->addSql('DROP TABLE category_spec_definition');
        $this->addSql('DROP TABLE spec_definition');
        $this->addSql('ALTER TABLE category ADD specs_list LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\'');
    }
}
