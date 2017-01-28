<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170128160047 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, exam_id INT DEFAULT NULL, question_id INT DEFAULT NULL, student_id INT DEFAULT NULL, is_good_ans TINYINT(1) NOT NULL, INDEX IDX_32993751578D5E91 (exam_id), INDEX IDX_329937511E27F6BF (question_id), INDEX IDX_32993751CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937511E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE score');
    }
}
