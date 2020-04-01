<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OperandsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OperandsTable Test Case
 */
class OperandsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OperandsTable
     */
    public $Operands;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Operands'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Operands') ? [] : ['className' => OperandsTable::class];
        $this->Operands = TableRegistry::getTableLocator()->get('Operands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Operands);

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
