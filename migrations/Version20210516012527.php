<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516012527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, user_name_admin VARCHAR(255) NOT NULL, email_admin VARCHAR(255) NOT NULL, mdp_admin VARCHAR(255) NOT NULL, INDEX IDX_880E0D768DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, last_name_client VARCHAR(255) NOT NULL, first_name_client VARCHAR(255) NOT NULL, phone_client INT NOT NULL, adress_client VARCHAR(255) NOT NULL, country_client VARCHAR(255) NOT NULL, city_client VARCHAR(255) NOT NULL, email_client VARCHAR(255) NOT NULL, mdp_client VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivred_task (id INT AUTO_INCREMENT NOT NULL, developer_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, task_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E8AD988864DD9267 (developer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer_categorie (developer_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_4DE79AC564DD9267 (developer_id), INDEX IDX_4DE79AC5BCF5E72D (categorie_id), PRIMARY KEY(developer_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D768DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE delivred_task ADD CONSTRAINT FK_E8AD988864DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id)');
        $this->addSql('ALTER TABLE developer_categorie ADD CONSTRAINT FK_4DE79AC564DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developer_categorie ADD CONSTRAINT FK_4DE79AC5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_527EDB2519EB6921 ON task (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2519EB6921');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE delivred_task');
        $this->addSql('DROP TABLE developer_categorie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_527EDB2519EB6921 ON task');
        $this->addSql('ALTER TABLE task DROP client_id');
    }
}
