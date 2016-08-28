<?php

namespace Runalyze\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Add session table to RUNALYZE & delete session column in account
 */
class Version20160813113407 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $prefix = $this->container->getParameter('database_prefix');

	    $this->addSql('CREATE TABLE `'.$prefix.'sessions` (`sess_id` VARBINARY(128) NOT NULL PRIMARY KEY, `sess_data` BLOB NOT NULL, `sess_time` INTEGER UNSIGNED NOT NULL, `sess_lifetime` MEDIUMINT NOT NULL) COLLATE utf8_bin, ENGINE = InnoDB');
	    $this->addSql('ALTER TABLE `'.$prefix.'account` DROP session_id');

    }
    
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $prefix = $this->container->getParameter('database_prefix');
        
	    $this->addSql('ALTER TABLE `'.$prefix.'account` ADD `session_id` varchar(64) NULL AFTER `salt`');
        $this->addSql('ALTER TABLE `'.$prefix.'account` ADD UNIQUE(`session_id`)');
    }

}
