<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mdc Entity
 *
 * @property int $id
 * @property string $mdcs_name_fr
 * @property string|null $mdcs_name_en
 * @property string|null $mdcs_desc_fr
 * @property string|null $mdcs_desc_en
 * @property int|null $mdcs_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Mdv[] $mdvs
 */
class Mdc extends Entity
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
        'theme_id' => true,
        'domain_id' => true,
        'unit_id' => true,
        'mdcs_name_fr' => true,
        'mdcs_name_en' => true,
        'mdcs_type' => true,
        'mdcs_desc_fr' => true,
        'mdcs_desc_en' => true,
        'mdcs_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'mdvs' => true
    ];
}
