<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308154739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_130459426B23C3C1');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942714819A0');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942C2428192');
        $this->addSql('DROP INDEX IDX_13045942C2428192 ON anime');
        $this->addSql('DROP INDEX IDX_13045942714819A0 ON anime');
        $this->addSql('DROP INDEX IDX_130459426B23C3C1 ON anime');
        $this->addSql('ALTER TABLE anime ADD genre_id INT NOT NULL, ADD type_id INT NOT NULL, ADD mangaka_id INT NOT NULL, DROP genre_id_id, DROP type_id_id, DROP mangaka_id_id');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_130459424296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942302BA454 FOREIGN KEY (mangaka_id) REFERENCES mangaka (id)');
        $this->addSql('CREATE INDEX IDX_130459424296D31F ON anime (genre_id)');
        $this->addSql('CREATE INDEX IDX_13045942C54C8C93 ON anime (type_id)');
        $this->addSql('CREATE INDEX IDX_13045942302BA454 ON anime (mangaka_id)');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF48314A9');
        $this->addSql('DROP INDEX IDX_E564F0BF48314A9 ON statut');
        $this->addSql('ALTER TABLE statut CHANGE statut_type_id_id statut_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA9FD96DF FOREIGN KEY (statut_type_id) REFERENCES statut_type (id)');
        $this->addSql('CREATE INDEX IDX_E564F0BFA9FD96DF ON statut (statut_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_130459424296D31F');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942C54C8C93');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942302BA454');
        $this->addSql('DROP INDEX IDX_130459424296D31F ON anime');
        $this->addSql('DROP INDEX IDX_13045942C54C8C93 ON anime');
        $this->addSql('DROP INDEX IDX_13045942302BA454 ON anime');
        $this->addSql('ALTER TABLE anime ADD genre_id_id INT NOT NULL, ADD type_id_id INT NOT NULL, ADD mangaka_id_id INT NOT NULL, DROP genre_id, DROP type_id, DROP mangaka_id');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_130459426B23C3C1 FOREIGN KEY (mangaka_id_id) REFERENCES mangaka (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942C2428192 FOREIGN KEY (genre_id_id) REFERENCES genre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_13045942C2428192 ON anime (genre_id_id)');
        $this->addSql('CREATE INDEX IDX_13045942714819A0 ON anime (type_id_id)');
        $this->addSql('CREATE INDEX IDX_130459426B23C3C1 ON anime (mangaka_id_id)');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA9FD96DF');
        $this->addSql('DROP INDEX IDX_E564F0BFA9FD96DF ON statut');
        $this->addSql('ALTER TABLE statut CHANGE statut_type_id statut_type_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF48314A9 FOREIGN KEY (statut_type_id_id) REFERENCES statut_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E564F0BF48314A9 ON statut (statut_type_id_id)');
    }
}
