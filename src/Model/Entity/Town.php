<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Town Entity
 *
 * @property int $id
 * @property int $department_id
 * @property string $town_name_fr
 * @property string|null $town_name_en
 * @property string|null $town_city
 * @property int|null $town_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Indicator[] $indicators
 * @property \App\Model\Entity\Mdv[] $mdvs
 * @property \App\Model\Entity\Structure[] $structures
 */
class Town extends Entity
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
        'department_id' => true,
        'town_name_fr' => true,
        'town_name_en' => true,
        'town_city' => true,
        'town_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'department' => true,
        'indicators' => true,
        'mdvs' => true,
        'structures' => true
    ];
}
