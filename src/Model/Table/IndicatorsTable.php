<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Indicators Model
 *
 * @property \App\Model\Table\DomainsTable&\Cake\ORM\Association\BelongsTo $Domains
 * @property \App\Model\Table\ThemesTable&\Cake\ORM\Association\BelongsTo $Themes
 * @property &\Cake\ORM\Association\BelongsTo $Mdcs
 * @property &\Cake\ORM\Association\BelongsToMany $Mdcs
 *
 * @method \App\Model\Entity\Indicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Indicator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Indicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Indicator|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indicator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IndicatorsTable extends Table
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

        $this->setTable('indicators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Domains', [
            'foreignKey' => 'domain_id'
        ]);
        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id'
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
            ->scalar('indicator_name_fr')
            ->maxLength('indicator_name_fr', 100)
            ->requirePresence('indicator_name_fr', 'create')
            ->notEmptyString('indicator_name_fr');

        $validator
            ->scalar('indicator_name_en')
            ->maxLength('indicator_name_en', 100)
            ->allowEmptyString('indicator_name_en');

        $validator
            ->scalar('indicator_desc_fr')
            ->maxLength('indicator_desc_fr', 255)
            ->allowEmptyString('indicator_desc_fr');

        $validator
            ->scalar('indicator_desc_en')
            ->maxLength('indicator_desc_en', 255)
            ->allowEmptyString('indicator_desc_en');

        $validator
            ->integer('indicator_state')
            ->allowEmptyString('indicator_state');

        $validator
            ->integer('indicator_agregat')
            ->allowEmptyString('indicator_agregat');

        $validator
            ->integer('indicator_unite')
            ->allowEmptyString('indicator_unite');

        $validator
            ->scalar('indicator_calcul')
            ->maxLength('indicator_calcul', 255)
            ->requirePresence('indicator_calcul', 'create')
            ->notEmptyString('indicator_calcul');

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
        $rules->add($rules->existsIn(['domain_id'], 'Domains'));
        $rules->add($rules->existsIn(['theme_id'], 'Themes'));

        return $rules;
    }
}
