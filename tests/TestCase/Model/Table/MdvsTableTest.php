<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MdvsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MdvsTable Test Case
 */
class MdvsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MdvsTable
     */
    public $Mdvs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Mdvs',
        'app.Regions',
        'app.Departments',
        'app.Towns',
        'app.Domains',
        'app.Themes',
        'app.Mdcs',
        'app.Indicators'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Mdvs') ? [] : ['className' => MdvsTable::class];
        $this->Mdvs = TableRegistry::getTableLocator()->get('Mdvs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mdvs);

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
