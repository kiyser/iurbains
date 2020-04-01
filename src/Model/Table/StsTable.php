<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sts Model
 *
 * @property \App\Model\Table\StructuresTable&\Cake\ORM\Association\HasMany $Structures
 *
 * @method \App\Model\Entity\St get($primaryKey, $options = [])
 * @method \App\Model\Entity\St newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\St[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\St|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\St saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\St patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\St[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\St findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StsTable extends Table
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

        $this->setTable('sts');
        $this->setDisplayField('sts_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Structures', [
            'foreignKey' => 'st_id'
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
            ->scalar('sts_name_fr')
            ->maxLength('sts_name_fr', 100)
            ->requirePresence('sts_name_fr', 'create')
            ->notEmptyString('sts_name_fr');

        $validator
            ->scalar('sts_name_en')
            ->maxLength('sts_name_en', 100)
            ->allowEmptyString('sts_name_en');

        $validator
            ->scalar('sts_abrev')
            ->maxLength('sts_abrev', 3)
            ->allowEmptyString('sts_abrev');

        $validator
            ->scalar('sts_desc_fr')
            ->maxLength('sts_desc_fr', 255)
            ->allowEmptyString('sts_desc_fr');

        $validator
            ->scalar('sts_desc_en')
            ->maxLength('sts_desc_en', 255)
            ->allowEmptyString('sts_desc_en');

        $validator
            ->integer('sts_state')
            ->allowEmptyString('sts_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
