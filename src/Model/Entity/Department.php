<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property int $region_id
 * @property string $department_name_fr
 * @property string|null $department_name_en
 * @property string|null $department_city
 * @property int|null $department_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Indicator[] $indicators
 * @property \App\Model\Entity\Mdv[] $mdvs
 * @property \App\Model\Entity\Structure[] $structures
 * @property \App\Model\Entity\Town[] $towns
 */
class Department extends Entity
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
        'region_id' => true,
        'department_name_fr' => true,
        'department_name_en' => true,
        'department_city' => true,
        'department_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'region' => true,
        'indicators' => true,
        'mdvs' => true,
        'structures' => true,
        'towns' => true
    ];
}
