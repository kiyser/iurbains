<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Structure Entity
 *
 * @property int $id
 * @property int $st_id
 * @property int $region_id
 * @property int|null $department_id
 * @property int|null $town_id
 * @property string $structure_name_fr
 * @property string|null $structure_name_en
 * @property string|null $structure_abrev
 * @property string|null $structure_desc_fr
 * @property string|null $structure_desc_en
 * @property int|null $structure_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\St $st
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Town $town
 * @property \App\Model\Entity\User[] $users
 */
class Structure extends Entity
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
        'st_id' => true,
        'region_id' => true,
        'department_id' => true,
        'town_id' => true,
        'structure_name_fr' => true,
        'structure_name_en' => true,
        'structure_abrev' => true,
        'structure_desc_fr' => true,
        'structure_desc_en' => true,
        'structure_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'st' => true,
        'region' => true,
        'department' => true,
        'town' => true,
        'users' => true
    ];
}
