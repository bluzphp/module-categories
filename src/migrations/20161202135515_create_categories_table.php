<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

use Phinx\Migration\AbstractMigration;

/**
 * CreateCategoriesTable
 */
class CreateCategoriesTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->execute('CREATE TABLE IF NOT EXISTS categories ( id BIGINT(20) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT, rootId BIGINT(20) unsigned, parentId BIGINT(20) unsigned, name VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, updated TIMESTAMP NOT NULL, CONSTRAINT categories_categories_id_fk FOREIGN KEY (parentId) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE);');
        $this->execute('CREATE UNIQUE INDEX UNIQUE_alias ON categories (parentId, alias);');
        $this->execute('REPLACE INTO `acl_privileges` (`roleId`, `module`, `privilege`) VALUES (2,\'categories\',\'Management\');');
    }
    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('categories');
        $this->execute('DELETE FROM `acl_privileges` WHERE module=\'categories\'');
    }
}
