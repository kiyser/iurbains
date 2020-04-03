<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Regions Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\HasMany $Departments
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\HasMany $Indicators
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 * @property \App\Model\Table\StructuresTable&\Cake\ORM\Association\HasMany $Structures
 *
 * @method \App\Model\Entity\Region get($primaryKey, $options = [])
 * @method \App\Model\Entity\Region newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Region[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Region|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Region saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Region patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Region[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Region findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegionsTable extends Table
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

        $this->setTable('regions');
        $this->setDisplayField('region_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Departments', [
            'foreignKey' => 'region_id'
        ]);
        $this->hasMany('Mdvs', [
            'foreignKey' => 'region_id'
        ]);
        $this->hasMany('Structures', [
            'foreignKey' => 'region_id'
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
            ->scalar('region_name_fr')
            ->maxLength('region_name_fr', 100)
            ->requirePresence('region_name_fr', 'create')
            ->notEmptyString('region_name_fr');

        $validator
            ->scalar('region_name_en')
            ->maxLength('region_name_en', 100)
            ->allowEmptyString('region_name_en');

        $validator
            ->scalar('region_city')
            ->maxLength('region_city', 100)
            ->allowEmptyString('region_city');

        $validator
            ->scalar('region_abrev')
            ->maxLength('region_abrev', 2)
            ->allowEmptyString('region_abrev');

        $validator
            ->integer('region_state')
            ->allowEmptyString('region_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
