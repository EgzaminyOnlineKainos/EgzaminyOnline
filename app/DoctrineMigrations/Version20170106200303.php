<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170106200303 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494E7E3C61F9 ON question (owner_id)');
        $this->addSql('ALTER TABLE user ADD username  VARCHAR(255) NOT NULL, ADD password  VARCHAR(255) NOT NULL, ADD displayName  VARCHAR(255) NOT NULL, ADD type  VARCHAR(255) NOT NULL, DROP username, DROP password, DROP displayName, DROP type');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E7E3C61F9');
        $this->addSql('DROP INDEX UNIQ_B6F7494E7E3C61F9 ON question');
        $this->addSql('ALTER TABLE question DROP owner_id');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD displayName VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP username , DROP password , DROP displayName , DROP type ');
    }
}
