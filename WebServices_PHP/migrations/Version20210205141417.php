<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205141417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DCF034CDB');
        $this->addSql('DROP INDEX IDX_6EEAA67DCF034CDB ON commande');
        $this->addSql('ALTER TABLE commande CHANGE id_usager_id usager_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4F36F0FC FOREIGN KEY (usager_id) REFERENCES usager (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D4F36F0FC ON commande (usager_id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B9AF8E3A3');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BD71E064B');
        $this->addSql('DROP INDEX IDX_3170B74B9AF8E3A3 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74BD71E064B ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id INT NOT NULL, ADD article_id INT NOT NULL, DROP id_commande_id, DROP id_article_id');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_3170B74B7294869C ON ligne_commande (article_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD PRIMARY KEY (commande_id, article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4F36F0FC');
        $this->addSql('DROP INDEX IDX_6EEAA67D4F36F0FC ON commande');
        $this->addSql('ALTER TABLE commande CHANGE usager_id id_usager_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DCF034CDB FOREIGN KEY (id_usager_id) REFERENCES usager (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67DCF034CDB ON commande (id_usager_id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B7294869C');
        $this->addSql('DROP INDEX IDX_3170B74B82EA2E54 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74B7294869C ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ligne_commande ADD id_commande_id INT NOT NULL, ADD id_article_id INT NOT NULL, DROP commande_id, DROP article_id');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3170B74B9AF8E3A3 ON ligne_commande (id_commande_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BD71E064B ON ligne_commande (id_article_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD PRIMARY KEY (id_commande_id, id_article_id)');
    }
}
