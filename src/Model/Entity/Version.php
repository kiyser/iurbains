<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Version Entity
 *
 * @property int $id
 * @property string $version_name_fr
 * @property string|null $version_name_en
 * @property \Cake\I18n\FrozenTime|null $version_dd
 * @property \Cake\I18n\FrozenTime|null $version_df
 * @property int|null $version_year
 * @property int|null $version_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Mdv[] $mdvs
 */
class Version extends Entity
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
        'version_name_fr' => true,
        'version_name_en' => true,
        'version_dd' => true,
        'version_df' => true,
        'version_year' => true,
        'version_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'mdvs' => true
    ];
}
