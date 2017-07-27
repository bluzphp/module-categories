<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

declare(strict_types=1);

namespace Application\Categories;

use Bluz\Proxy\Db;

/**
 * Class Table
 *
 * @package Application\Categories
 *
 * @method  static Row findRow($primaryKey)
 * @method  static Row findRowWhere($whereList)
 */
class Table extends \Bluz\Db\Table
{
    /**
     * Table
     *
     * @var string
     */
    protected $name = 'categories';

    /**
     * Primary key(s)
     * @var array
     */
    protected $primary = array('id');

    /**
     * Get root categories
     * @return array
     */
    public function getRootCategories()
    {
        return self::select()->where('parentId IS NULL')->orderBy('name')->execute();
    }
    
    /**
     * Build tree by root id
     * @param int $id
     * @return Row
     */
    public function buildTree($id = null)
    {
        $tree = $this->generateTree($id);
        return $tree[$id];
    }

    /**
     * Build tree by root alias
     * @param string $alias
     * @return Row
     */
    public function buildTreeByAlias($alias)
    {
        $current = self::findRow(['alias' => $alias]);

        return $this->buildTree($current['id']);
    }

    /**
     * Get all categories in tree by rootId
     * @param integer $rootId
     * @return Row[]
     */
    protected function generateTree($rootId)
    {
        /** @var Row[] $categories */
        $categories = Db::fetchGroup(
            'SELECT id, categories.* FROM categories WHERE rootId = :id or id = :id ORDER BY `name`',
            ['id' => $rootId],
            $this->rowClass
        );
        $categories = array_map('reset', $categories);


        foreach ($categories as $category) {
            if ($category->parentId && $category->id != $category->parentId) {
                $categories[$category->parentId]->addChild($category);
            }
        }
        return $categories;
    }
}
