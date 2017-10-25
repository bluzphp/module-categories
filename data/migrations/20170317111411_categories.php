<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

use Phinx\Migration\AbstractMigration;

/**
 * CreateCategoriesTable
 */
class Categories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function change()
    {
        $table = $this->table('categories');
        $table
            ->addColumn('rootId', 'integer')
            ->addColumn('parentId', 'integer', ['null' => true])
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('alias', 'string', ['length' => 255])
            ->addTimestamps('created', 'updated')
            ->addForeignKey('parentId', 'categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->addIndex(['parentId', 'alias'], ['unique' => true, 'name' => 'UNIQUE_categories_alias'])
            ->create();
    }
}
