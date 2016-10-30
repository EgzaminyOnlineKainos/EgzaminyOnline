<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20161030124207 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam_examtasks (exam_id INT NOT NULL, task_id INT NOT NULL, INDEX IDX_3F0A9666578D5E91 (exam_id), UNIQUE INDEX UNIQ_3F0A96668DB60186 (task_id), PRIMARY KEY(exam_id, task_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam_task (id INT AUTO_INCREMENT NOT NULL, task_type VARCHAR(255) DEFAULT \'closed\' NOT NULL, max_points DOUBLE PRECISION DEFAULT \'1\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam_examtasks ADD CONSTRAINT FK_3F0A9666578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE exam_examtasks ADD CONSTRAINT FK_3F0A96668DB60186 FOREIGN KEY (task_id) REFERENCES exam_task (id)');
        $this->addSql('DROP TABLE scientist');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exam_examtasks DROP FOREIGN KEY FK_3F0A9666578D5E91');
        $this->addSql('ALTER TABLE exam_examtasks DROP FOREIGN KEY FK_3F0A96668DB60186');
        $this->addSql('CREATE TABLE scientist (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, lastname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, color VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE exam_examtasks');
        $this->addSql('DROP TABLE exam_task');
    }
}
