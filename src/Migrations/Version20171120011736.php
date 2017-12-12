<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171120011736 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE Settings (id INTEGER NOT NULL, home_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1C33C29328CDC89C ON Settings (home_id)');
        $this->addSql('DROP INDEX UNIQ_B438191E989D9B62');
        $this->addSql('DROP INDEX IDX_B438191EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Page AS SELECT id, author_id, title, slug, content, home FROM Page');
        $this->addSql('DROP TABLE Page');
        $this->addSql('CREATE TABLE Page (id INTEGER NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, home BOOLEAN DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_B438191EF675F31B FOREIGN KEY (author_id) REFERENCES User (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO Page (id, author_id, title, slug, content, home) SELECT id, author_id, title, slug, content, home FROM __temp__Page');
        $this->addSql('DROP TABLE __temp__Page');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B438191E989D9B62 ON Page (slug)');
        $this->addSql('CREATE INDEX IDX_B438191EF675F31B ON Page (author_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE Settings');
        $this->addSql('DROP INDEX UNIQ_B438191E989D9B62');
        $this->addSql('DROP INDEX IDX_B438191EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Page AS SELECT id, author_id, title, slug, content, home FROM Page');
        $this->addSql('DROP TABLE Page');
        $this->addSql('CREATE TABLE Page (id INTEGER NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content CLOB NOT NULL, home BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO Page (id, author_id, title, slug, content, home) SELECT id, author_id, title, slug, content, home FROM __temp__Page');
        $this->addSql('DROP TABLE __temp__Page');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B438191E989D9B62 ON Page (slug)');
        $this->addSql('CREATE INDEX IDX_B438191EF675F31B ON Page (author_id)');
    }
}
