<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251103022354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, founded_year INT DEFAULT NULL, headquarters VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN brand.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN brand.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE camera (id SERIAL NOT NULL, brand_id INT NOT NULL, model VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, megapixels INT NOT NULL, sensor_type VARCHAR(50) NOT NULL, is_weather_sealed BOOLEAN NOT NULL, release_year INT NOT NULL, features TEXT DEFAULT NULL, stock_quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B1CEE0544F5D008 ON camera (brand_id)');
        $this->addSql('CREATE TABLE customer (id SERIAL NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(11) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, zip_code VARCHAR(10) NOT NULL, country VARCHAR(100) NOT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN customer.registered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE purchase (id SERIAL NOT NULL, customer_id INT NOT NULL, camera_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, status VARCHAR(50) NOT NULL, purchase_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, shipping_address VARCHAR(255) DEFAULT NULL, payment_method VARCHAR(50) DEFAULT NULL, notes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6117D13B9395C3F3 ON purchase (customer_id)');
        $this->addSql('CREATE INDEX IDX_6117D13BB47685CD ON purchase (camera_id)');
        $this->addSql('COMMENT ON COLUMN purchase.purchase_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE0544F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BB47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE camera DROP CONSTRAINT FK_3B1CEE0544F5D008');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13B9395C3F3');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13BB47685CD');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
