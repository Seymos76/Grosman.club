<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180909114936 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B1B5B63A6B');
        $this->addSql('DROP INDEX IDX_993387B1B5B63A6B ON cap');
        $this->addSql('ALTER TABLE cap DROP vat_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cap ADD vat_id INT NOT NULL');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B1B5B63A6B FOREIGN KEY (vat_id) REFERENCES vat (id)');
        $this->addSql('CREATE INDEX IDX_993387B1B5B63A6B ON cap (vat_id)');
    }
}
