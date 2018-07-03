<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180615024202 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pizzas_ingredients (pizzas_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_8E423D927F778084 (pizzas_id), INDEX IDX_8E423D923EC4DCE (ingredients_id), PRIMARY KEY(pizzas_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizzas_ingredients ADD CONSTRAINT FK_8E423D927F778084 FOREIGN KEY (pizzas_id) REFERENCES pizzas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizzas_ingredients ADD CONSTRAINT FK_8E423D923EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pizzas_ingredients');
    }
}
