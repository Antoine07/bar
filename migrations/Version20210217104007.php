<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217104007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C15C325FB');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CAB014612');
        $this->addSql('DROP INDEX IDX_649B469CAB014612 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C15C325FB ON statistic');
        $this->addSql('ALTER TABLE statistic DROP beers_id, DROP clients_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic ADD beers_id INT DEFAULT NULL, ADD clients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C15C325FB FOREIGN KEY (beers_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CAB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469CAB014612 ON statistic (clients_id)');
        $this->addSql('CREATE INDEX IDX_649B469C15C325FB ON statistic (beers_id)');
    }
}
