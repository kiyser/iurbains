<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Structures Model
 *
 * @property \App\Model\Table\StsTable&\Cake\ORM\Association\BelongsTo $Sts
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\TownsTable&\Cake\ORM\Association\BelongsTo $Towns
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Structure get($primaryKey, $options = [])
 * @method \App\Model\Entity\Structure newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Structure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Structure|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Structure saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Structure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Structure[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Structure findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StructuresTable extends Table
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

        $this->setTable('structures');
        $this->setDisplayField('structure_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sts', [
            'foreignKey' => 'st_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->belongsTo('Towns', [
            'foreignKey' => 'town_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'structure_id'
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
            ->scalar('structure_name_fr')
            ->maxLength('structure_name_fr', 100)
            ->requirePresence('structure_name_fr', 'create')
            ->notEmptyString('structure_name_fr');

        $validator
            ->scalar('structure_name_en')
            ->maxLength('structure_name_en', 100)
            ->allowEmptyString('structure_name_en');

        $validator
            ->scalar('structure_abrev')
            ->maxLength('structure_abrev', 10)
            ->allowEmptyString('structure_abrev');

        $validator
            ->scalar('structure_desc_fr')
            ->maxLength('structure_desc_fr', 255)
            ->allowEmptyString('structure_desc_fr');

        $validator
            ->scalar('structure_desc_en')
            ->maxLength('structure_desc_en', 255)
            ->allowEmptyString('structure_desc_en');

        $validator
            ->integer('structure_state')
            ->allowEmptyString('structure_state');

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
        $rules->add($rules->existsIn(['st_id'], 'Sts'));
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['town_id'], 'Towns'));

        return $rules;
    }
}
