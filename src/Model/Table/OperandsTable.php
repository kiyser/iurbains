<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Operands Model
 *
 * @method \App\Model\Entity\Operand get($primaryKey, $options = [])
 * @method \App\Model\Entity\Operand newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Operand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Operand|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operand saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Operand[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Operand findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OperandsTable extends Table
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

        $this->setTable('operands');
        $this->setDisplayField('operand_symbol');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('operand_name_fr')
            ->maxLength('operand_name_fr', 255)
            ->requirePresence('operand_name_fr', 'create')
            ->notEmptyString('operand_name_fr');

        $validator
            ->scalar('operand_name_en')
            ->maxLength('operand_name_en', 255)
            ->allowEmptyString('operand_name_en');

        $validator
            ->scalar('operand_abrev')
            ->maxLength('operand_abrev', 10)
            ->allowEmptyString('operand_abrev');

        $validator
            ->scalar('operand_symbol')
            ->maxLength('operand_symbol', 2)
            ->requirePresence('operand_symbol', 'create')
            ->notEmptyString('operand_symbol');

        $validator
            ->integer('operand_state')
            ->allowEmptyString('operand_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
