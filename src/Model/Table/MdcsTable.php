<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mdcs Model
 *
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 *
 * @method \App\Model\Entity\Mdc get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mdc newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mdc[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mdc|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mdc saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mdc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mdc[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mdc findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MdcsTable extends Table
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

        $this->setTable('mdcs');
        $this->setDisplayField('mdcs_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Mdvs', [
            'foreignKey' => 'mdc_id'
        ]);
        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Domains', [
            'foreignKey' => 'domain_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
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
            ->scalar('mdcs_name_fr')
            ->maxLength('mdcs_name_fr', 100)
            ->requirePresence('mdcs_name_fr', 'create')
            ->notEmptyString('mdcs_name_fr');

        $validator
            ->scalar('mdcs_name_en')
            ->maxLength('mdcs_name_en', 100)
            ->allowEmptyString('mdcs_name_en');

        $validator
            ->scalar('mdcs_type')
            ->allowEmptyString('mdcs_type');

        $validator
            ->scalar('mdcs_desc_fr')
            ->maxLength('mdcs_desc_fr', 255)
            ->allowEmptyString('mdcs_desc_fr');

        $validator
            ->scalar('mdcs_desc_en')
            ->maxLength('mdcs_desc_en', 255)
            ->allowEmptyString('mdcs_desc_en');

        $validator
            ->integer('mdcs_state')
            ->allowEmptyString('mdcs_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
	public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['theme_id'], 'Themes'));
        $rules->add($rules->existsIn(['domain_id'], 'Domains'));
        $rules->add($rules->existsIn(['unit_id'], 'Units'));

        return $rules;
    }
}
