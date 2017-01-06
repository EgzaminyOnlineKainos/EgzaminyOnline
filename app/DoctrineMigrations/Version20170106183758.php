<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170106183758 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, startDate DATETIME NOT NULL, endDate DATETIME NOT NULL, UNIQUE INDEX UNIQ_38BBA6C67E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams_questions (examId INT NOT NULL, questionId INT NOT NULL, INDEX IDX_59CE928D88A80D5C (examId), UNIQUE INDEX UNIQ_59CE928D4B476EBA (questionId), PRIMARY KEY(examId, questionId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams_students (examId INT NOT NULL, questionId INT NOT NULL, INDEX IDX_605B2ED588A80D5C (examId), UNIQUE INDEX UNIQ_605B2ED54B476EBA (questionId), PRIMARY KEY(examId, questionId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, question VARCHAR(255) NOT NULL, correctAnswer VARCHAR(255) NOT NULL, incorrectAnswerOne VARCHAR(255) NOT NULL, incorrectAnswerTwo VARCHAR(255) NOT NULL, incorrectAnswerThree VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username  VARCHAR(255) NOT NULL, password  VARCHAR(255) NOT NULL, displayName  VARCHAR(255) NOT NULL, type  VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C67E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exams_questions ADD CONSTRAINT FK_59CE928D88A80D5C FOREIGN KEY (examId) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE exams_questions ADD CONSTRAINT FK_59CE928D4B476EBA FOREIGN KEY (questionId) REFERENCES question (id)');
        $this->addSql('ALTER TABLE exams_students ADD CONSTRAINT FK_605B2ED588A80D5C FOREIGN KEY (examId) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE exams_students ADD CONSTRAINT FK_605B2ED54B476EBA FOREIGN KEY (questionId) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exams_questions DROP FOREIGN KEY FK_59CE928D88A80D5C');
        $this->addSql('ALTER TABLE exams_students DROP FOREIGN KEY FK_605B2ED588A80D5C');
        $this->addSql('ALTER TABLE exams_questions DROP FOREIGN KEY FK_59CE928D4B476EBA');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C67E3C61F9');
        $this->addSql('ALTER TABLE exams_students DROP FOREIGN KEY FK_605B2ED54B476EBA');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE exams_questions');
        $this->addSql('DROP TABLE exams_students');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE user');
    }
}
