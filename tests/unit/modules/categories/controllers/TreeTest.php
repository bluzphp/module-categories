<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Tests\Categories;

use Application\Tests\ControllerTestCase;

/**
 * @group    module-categories
 *
 * @package  Application\Tests\Categories
 * @author   Anton Shevchuk
 * @created  17.06.14 10:41
 */
class TreeTest extends ControllerTestCase
{
    /**
     * Dispatch module/controller
     */
    public function testControllerPage()
    {
        $this->setupSuperUserIdentity();

        $this->dispatch('/categories/tree/');
        
        self::assertModule('categories');
        self::assertController('tree');
        self::assertOk();
    }
}
