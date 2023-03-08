<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306095929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, favoris TINYINT(1) NOT NULL, INDEX IDX_E564F0BF79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_type (id INT AUTO_INCREMENT NOT NULL, statut_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_A9DDCA05F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statut_type ADD CONSTRAINT FK_A9DDCA05F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE anime ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_13045942F6203804 ON anime (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942F6203804');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF79F37AE5');
        $this->addSql('ALTER TABLE statut_type DROP FOREIGN KEY FK_A9DDCA05F6203804');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE statut_type');
        $this->addSql('DROP INDEX IDX_13045942F6203804 ON anime');
        $this->addSql('ALTER TABLE anime DROP statut_id');
    }
}
