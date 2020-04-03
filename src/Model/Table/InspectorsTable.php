<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inspectors Model
 *
 * @property \App\Model\Table\DataTable&\Cake\ORM\Association\BelongsTo $Data
 *
 * @method \App\Model\Entity\Inspector get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inspector newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inspector[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inspector|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inspector saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inspector patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inspector[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inspector findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InspectorsTable extends Table
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

        $this->setTable('inspectors');
        $this->setDisplayField('id');
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
            ->scalar('model_name')
            ->maxLength('model_name', 100)
            ->requirePresence('model_name', 'create')
            ->notEmptyString('model_name');

        $validator
            ->scalar('controller_action')
            ->maxLength('controller_action', 100)
            ->requirePresence('controller_action', 'create')
            ->notEmptyString('controller_action');

        $validator
            ->integer('id_data')
            ->allowEmptyString('id_data');

        $validator
            ->scalar('guest_system')
            ->maxLength('guest_system', 100)
            ->allowEmptyString('guest_system');

        $validator
            ->scalar('guest_browser')
            ->maxLength('guest_browser', 100)
            ->allowEmptyString('guest_browser');

        $validator
            ->scalar('guest_ip')
            ->maxLength('guest_ip', 100)
            ->allowEmptyString('guest_ip');

        $validator
            ->scalar('guest_lat')
            ->maxLength('guest_lat', 100)
            ->allowEmptyString('guest_lat');

        $validator
            ->scalar('guest_long')
            ->maxLength('guest_long', 100)
            ->allowEmptyString('guest_long');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
}
