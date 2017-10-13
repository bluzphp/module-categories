<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

use Phinx\Migration\AbstractMigration;

/**
 * CreateCategoriesTable
 */
class ModuleCategoriesPermissions extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $data = [
            [
                'roleId' => 2,
                'module' => 'categories',
                'privilege' => 'Management'
            ]
        ];

        $privileges = $this->table('acl_privileges');
        $privileges->insert($data)
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('DELETE FROM acl_privileges WHERE module = "categories"');
    }
}
