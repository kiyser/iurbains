<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MdcsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MdcsTable Test Case
 */
class MdcsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MdcsTable
     */
    public $Mdcs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Mdcs',
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
        $config = TableRegistry::getTableLocator()->exists('Mdcs') ? [] : ['className' => MdcsTable::class];
        $this->Mdcs = TableRegistry::getTableLocator()->get('Mdcs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mdcs);

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
}
