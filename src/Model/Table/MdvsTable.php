<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mdvs Model
 *
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\TownsTable&\Cake\ORM\Association\BelongsTo $Towns
 * @property \App\Model\Table\DomainsTable&\Cake\ORM\Association\BelongsTo $Domains
 * @property \App\Model\Table\ThemesTable&\Cake\ORM\Association\BelongsTo $Themes
 * @property \App\Model\Table\MdcsTable&\Cake\ORM\Association\BelongsTo $Mdcs
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\BelongsTo $Mdvs
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\HasMany $Indicators
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 *
 * @method \App\Model\Entity\Mdv get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mdv newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mdv[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mdv|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mdv saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mdv patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mdv[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mdv findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MdvsTable extends Table
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

        $this->setTable('mdvs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->belongsTo('Towns', [
            'foreignKey' => 'town_id'
        ]);
        $this->belongsTo('Mdcs', [
            'foreignKey' => 'mdc_id'
        ]);
        $this->belongsTo('Mdvs', [
            'foreignKey' => 'mdv_id'
        ]);
        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id'
        ]);
        $this->hasMany('Mdvs', [
            'foreignKey' => 'mdv_id'
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
            ->integer('mdvs_value')
            ->allowEmptyString('mdvs_value');

        $validator
            ->scalar('mdvs_source')
            ->maxLength('mdvs_source', 255)
            ->allowEmptyString('mdvs_source');

        $validator
            ->scalar('mdvs_unite')
            ->maxLength('mdvs_unite', 100)
            ->allowEmptyString('mdvs_unite');

        $validator
            ->integer('mdvs_state')
            ->allowEmptyString('mdvs_state');

		$validator
            ->dateTime('validate_date')
            ->allowEmptyDateTime('validate_date');
			
		$validator
            ->dateTime('publish_date')
            ->allowEmptyDateTime('publish_date');
			
        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('validate_by')
            ->allowEmptyString('validate_by');

        $validator
            ->integer('publish_by')
            ->allowEmptyString('publish_by');

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
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['town_id'], 'Towns'));
        $rules->add($rules->existsIn(['mdc_id'], 'Mdcs'));
        $rules->add($rules->existsIn(['mdv_id'], 'Mdvs'));

        return $rules;
    }
}
