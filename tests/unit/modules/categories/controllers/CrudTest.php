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
use Bluz\Http\StatusCode;

/**
 * @group    module-categories
 *
 * @package  Application\Tests\Categories
 * @author   Anton Shevchuk
 * @created  17.06.14 10:39
 */
class CrudTest extends ControllerTestCase
{
    /**
     * setUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        self::setupSuperUserIdentity();
        self::getApp()->useLayout(false);
    }

    /**
     * GET request should return FORM for create record
     */
    public function testCreateForm()
    {
        $this->dispatch('/categories/crud/');
        
        self::assertOk();
        self::assertQueryCount('form[method="POST"]', 1);
    }

    /**
     * GET request with ID record should return FORM for edit
     */
    public function testEditForm()
    {
        /*
        $this->dispatchRouter('/categories/crud/', ['id' => 1]);
        self::assertOk();

        self::assertQueryCount('form[method="PUT"]', 1);
        self::assertQueryCount('input[name="id"][value="1"]', 1);
        */

        // Remove the following lines when you implement this test.
        // Need to create element with ID
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * GET request with wrong ID record should return ERROR 404
     */
    public function testEditFormError()
    {
        $this->dispatch('/categories/crud/', ['id' => 100042]);
        self::assertResponseCode(StatusCode::NOT_FOUND);
    }
}
