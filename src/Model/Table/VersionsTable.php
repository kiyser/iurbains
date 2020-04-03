<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Versions Model
 *
 * @property \App\Model\Table\MdvsTable&\Cake\ORM\Association\HasMany $Mdvs
 *
 * @method \App\Model\Entity\Version get($primaryKey, $options = [])
 * @method \App\Model\Entity\Version newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Version[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Version|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Version saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Version patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Version[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Version findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VersionsTable extends Table
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

        $this->setTable('versions');
        $this->setDisplayField('version_name_fr');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Mdvs', [
            'foreignKey' => 'version_id'
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
            ->scalar('version_name_fr')
            ->maxLength('version_name_fr', 255)
            ->requirePresence('version_name_fr', 'create')
            ->notEmptyString('version_name_fr');

        $validator
            ->scalar('version_name_en')
            ->maxLength('version_name_en', 255)
            ->allowEmptyString('version_name_en');

        $validator
            ->dateTime('version_dd')
            ->allowEmptyDateTime('version_dd');

        $validator
            ->dateTime('version_df')
            ->allowEmptyDateTime('version_df');

        $validator
            ->integer('version_year')
            ->allowEmptyString('version_year');

        $validator
            ->integer('version_state')
            ->allowEmptyString('version_state');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
