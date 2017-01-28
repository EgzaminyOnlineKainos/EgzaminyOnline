<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170128234316 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exams_questions DROP INDEX UNIQ_59CE928D4B476EBA, ADD INDEX IDX_59CE928D4B476EBA (questionId)');
        $this->addSql('ALTER TABLE exams_students DROP INDEX UNIQ_605B2ED54B476EBA, ADD INDEX IDX_605B2ED54B476EBA (questionId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exams_questions DROP INDEX IDX_59CE928D4B476EBA, ADD UNIQUE INDEX UNIQ_59CE928D4B476EBA (questionId)');
        $this->addSql('ALTER TABLE exams_students DROP INDEX IDX_605B2ED54B476EBA, ADD UNIQUE INDEX UNIQ_605B2ED54B476EBA (questionId)');
    }
}
