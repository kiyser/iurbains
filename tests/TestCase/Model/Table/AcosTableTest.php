<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcosTable Test Case
 */
class AcosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcosTable
     */
    public $Acos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Acos',
        'app.Aros'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Acos') ? [] : ['className' => AcosTable::class];
        $this->Acos = TableRegistry::getTableLocator()->get('Acos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Acos);

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
