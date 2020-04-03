<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departments Model
 *
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\HasMany $Indicators
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 * @property \App\Model\Table\StructuresTable&\Cake\ORM\Association\HasMany $Structures
 * @property \App\Model\Table\TownsTable&\Cake\ORM\Association\HasMany $Towns
 *
 * @method \App\Model\Entity\Department get($primaryKey, $options = [])
 * @method \App\Model\Entity\Department newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Department[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Department|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Department[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Department findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartmentsTable extends Table
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

        $this->setTable('departments');
        $this->setDisplayField('department_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Mdvs', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('Structures', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('Towns', [
            'foreignKey' => 'department_id'
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
            ->scalar('department_name_fr')
            ->maxLength('department_name_fr', 100)
            ->requirePresence('department_name_fr', 'create')
            ->notEmptyString('department_name_fr');

        $validator
            ->scalar('department_name_en')
            ->maxLength('department_name_en', 100)
            ->allowEmptyString('department_name_en');

        $validator
            ->scalar('department_city')
            ->maxLength('department_city', 100)
            ->allowEmptyString('department_city');

        $validator
            ->integer('department_state')
            ->allowEmptyString('department_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

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
        $rules->add($rules->existsIn(['region_id'], 'Regions'));

        return $rules;
    }
}
