<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Units Model
 *
 * @method \App\Model\Entity\Unit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Unit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unit findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UnitsTable extends Table
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

        $this->setTable('units');
        $this->setDisplayField('unit_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
        $this->hasMany('Mdcs', [
            'foreignKey' => 'unit_id'
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
            ->scalar('unit_name_fr')
            ->maxLength('unit_name_fr', 255)
            ->requirePresence('unit_name_fr', 'create')
            ->notEmptyString('unit_name_fr');

        $validator
            ->scalar('unit_name_en')
            ->maxLength('unit_name_en', 255)
            ->allowEmptyString('unit_name_en');

        $validator
            ->scalar('unit_abrev')
            ->maxLength('unit_abrev', 10)
            ->requirePresence('unit_abrev', 'create')
            ->notEmptyString('unit_abrev');

        $validator
            ->integer('unit_state')
            ->allowEmptyString('unit_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
