<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205140355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligne_commande (id_commande_id INT NOT NULL, id_article_id INT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_3170B74B9AF8E3A3 (id_commande_id), INDEX IDX_3170B74BD71E064B (id_article_id), PRIMARY KEY(id_commande_id, id_article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commande CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE relation id_usager_id INT NOT NULL, CHANGE date__commande date_commande DATE NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DCF034CDB FOREIGN KEY (id_usager_id) REFERENCES usager (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DCF034CDB ON commande (id_usager_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DCF034CDB');
        $this->addSql('DROP INDEX IDX_6EEAA67DCF034CDB ON commande');
        $this->addSql('ALTER TABLE commande CHANGE statut statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id_usager_id relation INT NOT NULL, CHANGE date_commande date__commande DATE NOT NULL');
    }
}
