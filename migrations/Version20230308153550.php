<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308153550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime (id INT AUTO_INCREMENT NOT NULL, genre_id_id INT NOT NULL, type_id_id INT NOT NULL, mangaka_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, synopsis LONGTEXT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, nombre_episodes INT NOT NULL, INDEX IDX_13045942C2428192 (genre_id_id), INDEX IDX_13045942714819A0 (type_id_id), INDEX IDX_130459426B23C3C1 (mangaka_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (user_id INT NOT NULL, anime_id INT NOT NULL, date DATETIME DEFAULT NULL, commentaire LONGTEXT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8F91ABF0A76ED395 (user_id), INDEX IDX_8F91ABF0794BBE89 (anime_id), PRIMARY KEY(user_id, anime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mangaka (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (user_id INT NOT NULL, anime_id INT NOT NULL, statut_type_id_id INT NOT NULL, is_favoris TINYINT(1) NOT NULL, INDEX IDX_E564F0BF48314A9 (statut_type_id_id), INDEX IDX_E564F0BFA76ED395 (user_id), INDEX IDX_E564F0BF794BBE89 (anime_id), PRIMARY KEY(user_id, anime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, biographie LONGTEXT DEFAULT NULL, temps_visionnage VARCHAR(255) DEFAULT NULL, classement INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942C2428192 FOREIGN KEY (genre_id_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_13045942714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_130459426B23C3C1 FOREIGN KEY (mangaka_id_id) REFERENCES mangaka (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF48314A9 FOREIGN KEY (statut_type_id_id) REFERENCES statut_type (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BF794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942C2428192');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_13045942714819A0');
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_130459426B23C3C1');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0794BBE89');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF48314A9');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA76ED395');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BF794BBE89');
        $this->addSql('DROP TABLE anime');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE mangaka');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE statut_type');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
