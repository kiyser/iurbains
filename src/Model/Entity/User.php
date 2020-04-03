<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property int|null $group_id
 * @property int|null $structure_id
 * @property int|null $country_id
 * @property string $lastname
 * @property string|null $firstname
 * @property int|null $statut
 * @property int|null $civilite
 * @property int $portable
 * @property string|null $adresse
 * @property string $username
 * @property string $password
 * @property string $email
 * @property \Cake\I18n\FrozenTime|null $activate_date
 * @property int|null $activate_by
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Structure $structure
 * @property \App\Model\Entity\Country $country
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'group_id' => true,
        'structure_id' => true,
        'country_id' => true,
        'lastname' => true,
        'firstname' => true,
        'statut' => true,
        'civilite' => true,
        'portable' => true,
        'adresse' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'activate_date' => true,
        'activate_by' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'group' => true,
        'structure' => true,
        'country' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
	public function parentNode()
	{
		if (!$this->id) {
			return null;
		}
		if (isset($this->group_id)) {
			$groupId = $this->group_id;
		} else {
			$Users = TableRegistry::get('Users');
			$user = $Users->find('all', ['fields' => ['group_id']])->where(['id' => $this->id])->first();
			$groupId = $user->group_id;
		}
		if (!$groupId) {
			return null;
		}
		return ['Groups' => ['id' => $groupId]];
	}
}
