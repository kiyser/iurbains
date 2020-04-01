<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\StructuresTable&\Cake\ORM\Association\BelongsTo $Structures
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Acl.Acl', ['type' => 'requester']);

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id'
        ]);
        $this->belongsTo('Structures', [
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
            ->scalar('lastname')
            ->maxLength('lastname', 100)
            ->requirePresence('lastname', 'create')
            ->notEmptyString('lastname');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 100)
            ->allowEmptyString('firstname');

        $validator
            ->integer('statut')
            ->allowEmptyString('statut');

        $validator
            ->integer('civilite')
            ->allowEmptyString('civilite');

        $validator
            ->integer('portable')
            ->requirePresence('portable', 'create')
            ->notEmptyString('portable');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 250)
            ->allowEmptyString('adresse');

        $validator
            ->scalar('username')
            ->maxLength('username', 100)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
			->allowEmpty('password', 'update')
            ->notEmptyString('password', 'create');
			
		$validator->add('confirm_password', 'no-misspelling', [
						'rule' => ['compareWith', 'password'],
						'message' => 'Les mots de passe ne sont pas identiques.',
						]);
		
		$validator
            ->allowEmpty('confirm_password', 'update');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
			->add('email', 'valid', ['rule' => 'email', 'message' => 'Email invalide']);

        $validator
            ->dateTime('activate_date')
            ->allowEmptyDateTime('activate_date');

        $validator
            ->integer('activate_by')
            ->allowEmptyString('activate_by');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['structure_id'], 'Structures'));

        return $rules;
    }
	
	public function beforeSave1(\Cake\Event\Event $event, \Cake\ORM\Entity $entity, \ArrayObject $options)
	{
		$hasher = new DefaultPasswordHasher;
		$entity->password = $hasher->hash($entity->password);
		return true;
	}
}
