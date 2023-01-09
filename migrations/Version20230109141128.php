<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109141128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime ADD statut_id INT DEFAULT NULL, ADD mangaka_id INT NOT NULL');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942302BA454 FOREIGN KEY (mangaka_id) REFERENCES mangaka (id)');
        $this->addSql('CREATE INDEX IDX_13045942F6203804 ON anime (statut_id)');
        $this->addSql('CREATE INDEX IDX_13045942302BA454 ON anime (mangaka_id)');
        $this->addSql('ALTER TABLE avis ADD anime_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0794BBE89 ON avis (anime_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942F6203804');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942302BA454');
        $this->addSql('DROP INDEX IDX_13045942F6203804 ON anime');
        $this->addSql('DROP INDEX IDX_13045942302BA454 ON anime');
        $this->addSql('ALTER TABLE anime DROP statut_id, DROP mangaka_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0794BBE89');
        $this->addSql('DROP INDEX IDX_8F91ABF0794BBE89 ON avis');
        $this->addSql('ALTER TABLE avis DROP anime_id');
    }
}
