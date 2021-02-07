<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204100021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bestelling (id INT AUTO_INCREMENT NOT NULL, klant VARCHAR(255) NOT NULL, telefoonnummer VARCHAR(255) NOT NULL, afhaaldatum DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bestellingsregel (id INT AUTO_INCREMENT NOT NULL, recept_id INT NOT NULL, bestelling_id INT NOT NULL, aantal INT NOT NULL, INDEX IDX_86BE3094C6BF5295 (recept_id), INDEX IDX_86BE3094A2E63037 (bestelling_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fruit (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, seizoen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recept (id INT AUTO_INCREMENT NOT NULL, fruit_id INT NOT NULL, naam VARCHAR(255) NOT NULL, prijs_per_liter DOUBLE PRECISION NOT NULL, bereidingswijze LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_B92268A1BAC115F0 (fruit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bestellingsregel ADD CONSTRAINT FK_86BE3094C6BF5295 FOREIGN KEY (recept_id) REFERENCES recept (id)');
        $this->addSql('ALTER TABLE bestellingsregel ADD CONSTRAINT FK_86BE3094A2E63037 FOREIGN KEY (bestelling_id) REFERENCES bestelling (id)');
        $this->addSql('ALTER TABLE recept ADD CONSTRAINT FK_B92268A1BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestellingsregel DROP FOREIGN KEY FK_86BE3094A2E63037');
        $this->addSql('ALTER TABLE recept DROP FOREIGN KEY FK_B92268A1BAC115F0');
        $this->addSql('ALTER TABLE bestellingsregel DROP FOREIGN KEY FK_86BE3094C6BF5295');
        $this->addSql('DROP TABLE bestelling');
        $this->addSql('DROP TABLE bestellingsregel');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP TABLE recept');
        $this->addSql('DROP TABLE user');
    }
}
