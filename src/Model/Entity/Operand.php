<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Operand Entity
 *
 * @property int $id
 * @property string $operand_name_fr
 * @property string|null $operand_name_en
 * @property string $operand_abrev
 * @property string $operand_symbol
 * @property int|null $operand_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 */
class Operand extends Entity
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
        'operand_name_fr' => true,
        'operand_name_en' => true,
        'operand_abrev' => true,
        'operand_symbol' => true,
        'operand_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true
    ];
}
