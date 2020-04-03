<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Region Entity
 *
 * @property int $id
 * @property string $region_name_fr
 * @property string|null $region_name_en
 * @property string|null $region_city
 * @property string|null $region_abrev
 * @property int|null $region_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Department[] $departments
 * @property \App\Model\Entity\Indicator[] $indicators
 * @property \App\Model\Entity\Mdv[] $mdvs
 * @property \App\Model\Entity\Structure[] $structures
 */
class Region extends Entity
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
        'region_name_fr' => true,
        'region_name_en' => true,
        'region_city' => true,
        'region_abrev' => true,
        'region_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'departments' => true,
        'indicators' => true,
        'mdvs' => true,
        'structures' => true
    ];
}
