<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MdcsIndicators Model
 *
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\BelongsTo $Indicators
 * @property \App\Model\Table\MdcsTable&\Cake\ORM\Association\BelongsTo $Mdcs
 *
 * @method \App\Model\Entity\MdcsIndicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\MdcsIndicator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MdcsIndicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MdcsIndicator|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MdcsIndicator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MdcsIndicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MdcsIndicator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MdcsIndicator findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MdcsIndicatorsTable extends Table
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

        $this->setTable('mdcs_indicators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Indicators', [
            'foreignKey' => 'indicator_id'
        ]);
        $this->belongsTo('Mdcs', [
            'foreignKey' => 'mdc_id'
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
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['indicator_id'], 'Indicators'));
        $rules->add($rules->existsIn(['mdc_id'], 'Mdcs'));

        return $rules;
    }
}
