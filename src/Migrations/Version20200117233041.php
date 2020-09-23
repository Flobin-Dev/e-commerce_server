<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117233041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_spec ADD spec_id INT NOT NULL, ADD value LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE product_spec ADD CONSTRAINT FK_4DE6359FAA8FA4FB FOREIGN KEY (spec_id) REFERENCES spec_definition (id)');
        $this->addSql('CREATE INDEX IDX_4DE6359FAA8FA4FB ON product_spec (spec_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_spec DROP FOREIGN KEY FK_4DE6359FAA8FA4FB');
        $this->addSql('DROP INDEX IDX_4DE6359FAA8FA4FB ON product_spec');
        $this->addSql('ALTER TABLE product_spec DROP spec_id, DROP value');
    }
}
