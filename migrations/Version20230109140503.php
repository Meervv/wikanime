<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109140503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime ADD genre_id INT NOT NULL, ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_130459424296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_1304594259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_130459424296D31F ON anime (genre_id)');
        $this->addSql('CREATE INDEX IDX_1304594259027487 ON anime (theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_130459424296D31F');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_1304594259027487');
        $this->addSql('DROP INDEX IDX_130459424296D31F ON anime');
        $this->addSql('DROP INDEX IDX_1304594259027487 ON anime');
        $this->addSql('ALTER TABLE anime DROP genre_id, DROP theme_id');
    }
}
