<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524140308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE human (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE human_cat (human_id INT NOT NULL, cat_id INT NOT NULL, INDEX IDX_18B8155E8ABD4580 (human_id), INDEX IDX_18B8155EE6ADA943 (cat_id), PRIMARY KEY(human_id, cat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE human_cat ADD CONSTRAINT FK_18B8155E8ABD4580 FOREIGN KEY (human_id) REFERENCES human (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE human_cat ADD CONSTRAINT FK_18B8155EE6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE human_cat DROP FOREIGN KEY FK_18B8155E8ABD4580');
        $this->addSql('DROP TABLE human');
        $this->addSql('DROP TABLE human_cat');
    }
}
