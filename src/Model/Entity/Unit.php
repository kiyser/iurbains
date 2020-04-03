<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unit Entity
 *
 * @property int $id
 * @property string $unit_name_fr
 * @property string|null $unit_name_en
 * @property string $unit_abrev
 * @property int|null $unit_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 */
class Unit extends Entity
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
        'unit_name_fr' => true,
        'unit_name_en' => true,
        'unit_abrev' => true,
        'unit_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true
    ];
}
