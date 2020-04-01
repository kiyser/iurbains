<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Themes Model
 *
 * @property \App\Model\Table\DomainsTable&\Cake\ORM\Association\HasMany $Domains
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\HasMany $Indicators
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 *
 * @method \App\Model\Entity\Theme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Theme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Theme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Theme|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Theme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Theme findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ThemesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('themes');
        $this->setDisplayField('theme_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Domains', [
            'foreignKey' => 'theme_id'
        ]);
        $this->hasMany('Mdcs', [
            'foreignKey' => 'theme_id'
        ]);
        $this->hasMany('Indicators', [
            'foreignKey' => 'theme_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('theme_name_fr')
            ->maxLength('theme_name_fr', 100)
            ->requirePresence('theme_name_fr', 'create')
            ->notEmptyString('theme_name_fr');

        $validator
            ->scalar('theme_name_en')
            ->maxLength('theme_name_en', 100)
            ->allowEmptyString('theme_name_en');

        $validator
            ->scalar('theme_abrev')
            ->maxLength('theme_abrev', 5)
            ->allowEmptyString('theme_abrev');

        $validator
            ->scalar('theme_desc_fr')
            ->maxLength('theme_desc_fr', 255)
            ->allowEmptyString('theme_desc_fr');

        $validator
            ->scalar('theme_desc_en')
            ->maxLength('theme_desc_en', 255)
            ->allowEmptyString('theme_desc_en');

        $validator
            ->integer('theme_state')
            ->allowEmptyString('theme_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
