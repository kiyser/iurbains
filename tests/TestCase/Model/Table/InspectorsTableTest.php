<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InspectorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InspectorsTable Test Case
 */
class InspectorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InspectorsTable
     */
    public $Inspectors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Inspectors',
        'app.Data'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Inspectors') ? [] : ['className' => InspectorsTable::class];
        $this->Inspectors = TableRegistry::getTableLocator()->get('Inspectors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Inspectors);

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
