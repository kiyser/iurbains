<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StsTable Test Case
 */
class StsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StsTable
     */
    public $Sts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Sts',
        'app.Structures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sts') ? [] : ['className' => StsTable::class];
        $this->Sts = TableRegistry::getTableLocator()->get('Sts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sts);

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
