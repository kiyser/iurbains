<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StructuresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StructuresTable Test Case
 */
class StructuresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StructuresTable
     */
    public $Structures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Structures',
        'app.Sts',
        'app.Regions',
        'app.Departments',
        'app.Towns',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Structures') ? [] : ['className' => StructuresTable::class];
        $this->Structures = TableRegistry::getTableLocator()->get('Structures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Structures);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
