<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906162306 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordering (id INT AUTO_INCREMENT NOT NULL, vat_id INT DEFAULT NULL, user_id INT NOT NULL, cap_id INT NOT NULL, date_creation DATETIME NOT NULL, number VARCHAR(20) NOT NULL, date_payment DATETIME DEFAULT NULL, total_ht DOUBLE PRECISION DEFAULT NULL, total_vat DOUBLE PRECISION DEFAULT NULL, total_ttc DOUBLE PRECISION DEFAULT NULL, INDEX IDX_7B313367B5B63A6B (vat_id), INDEX IDX_7B313367A76ED395 (user_id), INDEX IDX_7B31336769CF3E14 (cap_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, ordering_id INT NOT NULL, date_creation DATETIME NOT NULL, number VARCHAR(20) NOT NULL, date_payment DATETIME DEFAULT NULL, total_ht DOUBLE PRECISION DEFAULT NULL, total_vat DOUBLE PRECISION DEFAULT NULL, total_ttc DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_906517448E6C7DE4 (ordering_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cap (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, color_id INT NOT NULL, patch_id INT NOT NULL, vat_id INT NOT NULL, date_creation DATETIME NOT NULL, name VARCHAR(255) DEFAULT NULL, pricing DOUBLE PRECISION DEFAULT NULL, INDEX IDX_993387B1C54C8C93 (type_id), INDEX IDX_993387B17ADA1FB5 (color_id), INDEX IDX_993387B1CD00882C (patch_id), INDEX IDX_993387B1B5B63A6B (vat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cap_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cap_patch (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, stock INT NOT NULL, INDEX IDX_AA1F02C8F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_address (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, label VARCHAR(50) NOT NULL, zipcode VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_address_user (user_address_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_70137AA052D06999 (user_address_id), INDEX IDX_70137AA0A76ED395 (user_id), PRIMARY KEY(user_address_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cap_color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, rgba VARCHAR(20) NOT NULL, hexa VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', date_register DATETIME NOT NULL, last_connexion DATETIME DEFAULT NULL, token VARCHAR(100) DEFAULT NULL, activation_code VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordering ADD CONSTRAINT FK_7B313367B5B63A6B FOREIGN KEY (vat_id) REFERENCES vat (id)');
        $this->addSql('ALTER TABLE ordering ADD CONSTRAINT FK_7B313367A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordering ADD CONSTRAINT FK_7B31336769CF3E14 FOREIGN KEY (cap_id) REFERENCES cap (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517448E6C7DE4 FOREIGN KEY (ordering_id) REFERENCES ordering (id)');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B1C54C8C93 FOREIGN KEY (type_id) REFERENCES cap_type (id)');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B17ADA1FB5 FOREIGN KEY (color_id) REFERENCES cap_color (id)');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B1CD00882C FOREIGN KEY (patch_id) REFERENCES cap_patch (id)');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B1B5B63A6B FOREIGN KEY (vat_id) REFERENCES vat (id)');
        $this->addSql('ALTER TABLE cap_patch ADD CONSTRAINT FK_AA1F02C8F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_address_user ADD CONSTRAINT FK_70137AA052D06999 FOREIGN KEY (user_address_id) REFERENCES user_address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_address_user ADD CONSTRAINT FK_70137AA0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ordering DROP FOREIGN KEY FK_7B313367B5B63A6B');
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B1B5B63A6B');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517448E6C7DE4');
        $this->addSql('ALTER TABLE ordering DROP FOREIGN KEY FK_7B31336769CF3E14');
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B1C54C8C93');
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B1CD00882C');
        $this->addSql('ALTER TABLE user_address_user DROP FOREIGN KEY FK_70137AA052D06999');
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B17ADA1FB5');
        $this->addSql('ALTER TABLE ordering DROP FOREIGN KEY FK_7B313367A76ED395');
        $this->addSql('ALTER TABLE cap_patch DROP FOREIGN KEY FK_AA1F02C8F675F31B');
        $this->addSql('ALTER TABLE user_address_user DROP FOREIGN KEY FK_70137AA0A76ED395');
        $this->addSql('DROP TABLE vat');
        $this->addSql('DROP TABLE ordering');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE cap');
        $this->addSql('DROP TABLE cap_type');
        $this->addSql('DROP TABLE cap_patch');
        $this->addSql('DROP TABLE user_address');
        $this->addSql('DROP TABLE user_address_user');
        $this->addSql('DROP TABLE cap_color');
        $this->addSql('DROP TABLE user');
    }
}
