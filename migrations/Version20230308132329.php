<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308132329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942F6203804');
        $this->addSql('DROP INDEX IDX_13045942F6203804 ON anime');
        $this->addSql('ALTER TABLE anime DROP statut_id');
        $this->addSql('ALTER TABLE statut ADD user_id INT NOT NULL, ADD statut_type_id INT NOT NULL, ADD anime_id INT NOT NULL, ADD favoris TINYINT(1) NOT NULL, DROP libelle');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA9FD96DF FOREIGN KEY (statut_type_id) REFERENCES statut_type (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
        $this->addSql('CREATE INDEX IDX_E564F0BFA76ED395 ON statut (user_id)');
        $this->addSql('CREATE INDEX IDX_E564F0BFA9FD96DF ON statut (statut_type_id)');
        $this->addSql('CREATE INDEX IDX_E564F0BF794BBE89 ON statut (anime_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA9FD96DF');
        $this->addSql('DROP TABLE statut_type');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA76ED395');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF794BBE89');
        $this->addSql('DROP INDEX IDX_E564F0BFA76ED395 ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BFA9FD96DF ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BF794BBE89 ON statut');
        $this->addSql('ALTER TABLE statut ADD libelle VARCHAR(255) NOT NULL, DROP user_id, DROP statut_type_id, DROP anime_id, DROP favoris');
        $this->addSql('ALTER TABLE anime ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_13045942F6203804 ON anime (statut_id)');
    }
}
