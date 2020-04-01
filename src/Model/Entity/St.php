<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * St Entity
 *
 * @property int $id
 * @property string $sts_name_fr
 * @property string|null $sts_name_en
 * @property string|null $sts_abrev
 * @property string|null $sts_desc_fr
 * @property string|null $sts_desc_en
 * @property int|null $sts_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Structure[] $structures
 */
class St extends Entity
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
        'sts_name_fr' => true,
        'sts_name_en' => true,
        'sts_abrev' => true,
        'sts_desc_fr' => true,
        'sts_desc_en' => true,
        'sts_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'structures' => true
    ];
}
