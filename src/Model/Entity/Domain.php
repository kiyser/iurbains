<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Domain Entity
 *
 * @property int $id
 * @property int $theme_id
 * @property string $domain_name_fr
 * @property string|null $domain_name_en
 * @property string|null $domain_abrev
 * @property string|null $domain_desc_fr
 * @property string|null $domain_desc_en
 * @property int|null $domain_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Theme $theme
 * @property \App\Model\Entity\Indicator[] $indicators
 * @property \App\Model\Entity\Mdv[] $mdvs
 */
class Domain extends Entity
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
        'domain_name_fr' => true,
        'domain_name_en' => true,
        'domain_abrev' => true,
        'domain_desc_fr' => true,
        'domain_desc_en' => true,
        'domain_state' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'theme' => true,
        'indicators' => true,
        'mdvs' => true
    ];
}
