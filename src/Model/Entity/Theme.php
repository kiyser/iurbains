<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Theme Entity
 *
 * @property int $id
 * @property string $theme_name_fr
 * @property string|null $theme_name_en
 * @property string|null $theme_abrev
 * @property string|null $theme_desc_fr
 * @property string|null $theme_desc_en
 * @property int|null $theme_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Domain[] $domains
 * @property \App\Model\Entity\Indicator[] $indicators
 * @property \App\Model\Entity\Mdv[] $mdvs
 */
class Theme extends Entity
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
        'theme_name_fr' => true,
        'theme_name_en' => true,
        'theme_abrev' => true,
        'theme_desc_fr' => true,
        'theme_desc_en' => true,
        'theme_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'domains' => true,
        'indicators' => true,
        'mdvs' => true
    ];
}
