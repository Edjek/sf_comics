<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114083719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB58CFC54FAB');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB581BC7E6B6');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB586995AC4C');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB58CFC54FAB FOREIGN KEY (designer_id) REFERENCES designer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB581BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB586995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F71AE76A2');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F71AE76A2 FOREIGN KEY (comics_id) REFERENCES comics (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB581BC7E6B6');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB58CFC54FAB');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB586995AC4C');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB581BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id)');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB58CFC54FAB FOREIGN KEY (designer_id) REFERENCES designer (id)');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB586995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F71AE76A2');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F71AE76A2 FOREIGN KEY (comics_id) REFERENCES comics (id)');
    }
}
