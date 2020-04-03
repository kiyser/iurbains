<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Domains Model
 *
 * @property \App\Model\Table\ThemesTable&\Cake\ORM\Association\BelongsTo $Themes
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\HasMany $Indicators
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 *
 * @method \App\Model\Entity\Domain get($primaryKey, $options = [])
 * @method \App\Model\Entity\Domain newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Domain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Domain|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Domain saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Domain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Domain[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Domain findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DomainsTable extends Table
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

        $this->setTable('domains');
        $this->setDisplayField('domain_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Mdcs', [
            'foreignKey' => 'domain_id'
        ]);
        $this->hasMany('Indicators', [
            'foreignKey' => 'domain_id'
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
            ->scalar('domain_name_fr')
            ->maxLength('domain_name_fr', 100)
            ->requirePresence('domain_name_fr', 'create')
            ->notEmptyString('domain_name_fr');

        $validator
            ->scalar('domain_name_en')
            ->maxLength('domain_name_en', 100)
            ->allowEmptyString('domain_name_en');

        $validator
            ->scalar('domain_abrev')
            ->maxLength('domain_abrev', 5)
            ->allowEmptyString('domain_abrev');

        $validator
            ->scalar('domain_desc_fr')
            ->maxLength('domain_desc_fr', 255)
            ->allowEmptyString('domain_desc_fr');

        $validator
            ->scalar('domain_desc_en')
            ->maxLength('domain_desc_en', 255)
            ->allowEmptyString('domain_desc_en');

        $validator
            ->integer('domain_state')
            ->allowEmptyString('domain_state');

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
        $rules->add($rules->existsIn(['theme_id'], 'Themes'));

        return $rules;
    }
}
