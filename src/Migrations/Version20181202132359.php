<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181202132359 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_element ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_element ADD CONSTRAINT FK_C99B4387727ACA70 FOREIGN KEY (parent_id) REFERENCES menu_element (id)');
        $this->addSql('CREATE INDEX IDX_C99B4387727ACA70 ON menu_element (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_element DROP FOREIGN KEY FK_C99B4387727ACA70');
        $this->addSql('DROP INDEX IDX_C99B4387727ACA70 ON menu_element');
        $this->addSql('ALTER TABLE menu_element DROP parent_id');
    }
}
