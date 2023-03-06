<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306101536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statut ADD user_id INT NOT NULL, ADD statut_type_id INT NOT NULL, ADD anime_id INT NOT NULL');
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
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA76ED395');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA9FD96DF');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF794BBE89');
        $this->addSql('DROP INDEX IDX_E564F0BFA76ED395 ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BFA9FD96DF ON statut');
        $this->addSql('DROP INDEX IDX_E564F0BF794BBE89 ON statut');
        $this->addSql('ALTER TABLE statut DROP user_id, DROP statut_type_id, DROP anime_id');
    }
}
