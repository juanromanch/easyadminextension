<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190814072014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articulo (id INT AUTO_INCREMENT NOT NULL, codart VARCHAR(15) DEFAULT NULL, codalt VARCHAR(15) DEFAULT NULL, descart VARCHAR(100) DEFAULT NULL, prcventa DOUBLE PRECISION DEFAULT NULL, obsoleto TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cabepedv (id INT AUTO_INCREMENT NOT NULL, codcli_id INT DEFAULT NULL, codrep_id INT DEFAULT NULL, fecha DATE NOT NULL, observaciones LONGTEXT DEFAULT NULL, INDEX IDX_9FBDBAF1F859303D (codcli_id), INDEX IDX_9FBDBAF110D29B67 (codrep_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, codrep_id INT DEFAULT NULL, codcli VARCHAR(8) DEFAULT NULL, nomcli VARCHAR(100) DEFAULT NULL, dircli VARCHAR(60) DEFAULT NULL, pobcli VARCHAR(60) DEFAULT NULL, obsoleto TINYINT(1) DEFAULT NULL, INDEX IDX_50FE07D710D29B67 (codrep_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE linepedi (id INT AUTO_INCREMENT NOT NULL, idpedido_id INT NOT NULL, idarticulo_id INT NOT NULL, unidades INT NOT NULL, INDEX IDX_8FB82BB4364FCCCF (idpedido_id), INDEX IDX_8FB82BB4EB7D5F66 (idarticulo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE represen (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', nomrep VARCHAR(50) DEFAULT NULL, codrep VARCHAR(8) NOT NULL, UNIQUE INDEX UNIQ_3226962D92FC23A8 (username_canonical), UNIQUE INDEX UNIQ_3226962DA0D96FBF (email_canonical), UNIQUE INDEX UNIQ_3226962DC05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cabepedv ADD CONSTRAINT FK_9FBDBAF1F859303D FOREIGN KEY (codcli_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE cabepedv ADD CONSTRAINT FK_9FBDBAF110D29B67 FOREIGN KEY (codrep_id) REFERENCES represen (id)');
        $this->addSql('ALTER TABLE clientes ADD CONSTRAINT FK_50FE07D710D29B67 FOREIGN KEY (codrep_id) REFERENCES represen (id)');
        $this->addSql('ALTER TABLE linepedi ADD CONSTRAINT FK_8FB82BB4364FCCCF FOREIGN KEY (idpedido_id) REFERENCES cabepedv (id)');
        $this->addSql('ALTER TABLE linepedi ADD CONSTRAINT FK_8FB82BB4EB7D5F66 FOREIGN KEY (idarticulo_id) REFERENCES articulo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE linepedi DROP FOREIGN KEY FK_8FB82BB4EB7D5F66');
        $this->addSql('ALTER TABLE linepedi DROP FOREIGN KEY FK_8FB82BB4364FCCCF');
        $this->addSql('ALTER TABLE cabepedv DROP FOREIGN KEY FK_9FBDBAF1F859303D');
        $this->addSql('ALTER TABLE cabepedv DROP FOREIGN KEY FK_9FBDBAF110D29B67');
        $this->addSql('ALTER TABLE clientes DROP FOREIGN KEY FK_50FE07D710D29B67');
        $this->addSql('DROP TABLE articulo');
        $this->addSql('DROP TABLE cabepedv');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE linepedi');
        $this->addSql('DROP TABLE represen');
    }
}
