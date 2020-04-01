<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MdcsIndicatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MdcsIndicatorsTable Test Case
 */
class MdcsIndicatorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MdcsIndicatorsTable
     */
    public $MdcsIndicators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MdcsIndicators',
        'app.Indicators',
        'app.Mdcs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MdcsIndicators') ? [] : ['className' => MdcsIndicatorsTable::class];
        $this->MdcsIndicators = TableRegistry::getTableLocator()->get('MdcsIndicators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MdcsIndicators);

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
