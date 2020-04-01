<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndicatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndicatorsTable Test Case
 */
class IndicatorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndicatorsTable
     */
    public $Indicators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Indicators',
        'app.Regions',
        'app.Departments',
        'app.Towns',
        'app.Domains',
        'app.Themes',
        'app.Mdvs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Indicators') ? [] : ['className' => IndicatorsTable::class];
        $this->Indicators = TableRegistry::getTableLocator()->get('Indicators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Indicators);

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
