<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216210730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666AD53B6268F');
        $this->addSql('DROP INDEX IDX_58F666AD53B6268F ON beer');
        $this->addSql('ALTER TABLE beer DROP statistic_id');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045553B6268F');
        $this->addSql('DROP INDEX IDX_C744045553B6268F ON client');
        $this->addSql('ALTER TABLE client DROP statistic_id');
        $this->addSql('ALTER TABLE statistic ADD beers_id INT DEFAULT NULL, ADD clients_id INT DEFAULT NULL, ADD beer_id INT DEFAULT NULL, ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C15C325FB FOREIGN KEY (beers_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CAB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469C15C325FB ON statistic (beers_id)');
        $this->addSql('CREATE INDEX IDX_649B469CAB014612 ON statistic (clients_id)');
        $this->addSql('CREATE INDEX IDX_649B469CD0989053 ON statistic (beer_id)');
        $this->addSql('CREATE INDEX IDX_649B469C19EB6921 ON statistic (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beer ADD statistic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666AD53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('CREATE INDEX IDX_58F666AD53B6268F ON beer (statistic_id)');
        $this->addSql('ALTER TABLE client ADD statistic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045553B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('CREATE INDEX IDX_C744045553B6268F ON client (statistic_id)');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C15C325FB');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CAB014612');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CD0989053');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C19EB6921');
        $this->addSql('DROP INDEX IDX_649B469C15C325FB ON statistic');
        $this->addSql('DROP INDEX IDX_649B469CAB014612 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469CD0989053 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C19EB6921 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP beers_id, DROP clients_id, DROP beer_id, DROP client_id');
    }
}
