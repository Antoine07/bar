<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216204216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, statistic_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, weight NUMERIC(5, 1) DEFAULT NULL, number_beer INT DEFAULT NULL, INDEX IDX_C744045553B6268F (statistic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, score INT NOT NULL, category_id VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045553B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('ALTER TABLE beer ADD statistic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666AD53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('CREATE INDEX IDX_58F666AD53B6268F ON beer (statistic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666AD53B6268F');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045553B6268F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP INDEX IDX_58F666AD53B6268F ON beer');
        $this->addSql('ALTER TABLE beer DROP statistic_id');
    }
}
