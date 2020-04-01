<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThemesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThemesTable Test Case
 */
class ThemesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ThemesTable
     */
    public $Themes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Themes',
        'app.Domains',
        'app.Indicators',
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
        $config = TableRegistry::getTableLocator()->exists('Themes') ? [] : ['className' => ThemesTable::class];
        $this->Themes = TableRegistry::getTableLocator()->get('Themes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Themes);

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
