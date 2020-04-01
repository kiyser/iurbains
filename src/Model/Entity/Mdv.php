<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mdv Entity
 *
 * @property int $id
 * @property int|null $region_id
 * @property int|null $department_id
 * @property int|null $town_id
 * @property int|null $domain_id
 * @property int|null $theme_id
 * @property int|null $mdc_id
 * @property int|null $mdv_id
 * @property string $mdvs_name_fr
 * @property string|null $mdvs_name_en
 * @property string|null $mdvs_desc_fr
 * @property string|null $mdvs_desc_en
 * @property int|null $mdvs_state
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Town $town
 * @property \App\Model\Entity\Domain $domain
 * @property \App\Model\Entity\Theme $theme
 * @property \App\Model\Entity\Mdc $mdc
 * @property \App\Model\Entity\Mdv[] $mdvs
 * @property \App\Model\Entity\Indicator[] $indicators
 */
class Mdv extends Entity
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
        'department_id' => true,
        'town_id' => true,
        'mdc_id' => true,
        'mdv_id' => true,
        'version_id' => true,
        'mdvs_value' => true,
        'mdvs_source' => true,
        'mdvs_unite' => true,
        'mdvs_state' => true,
        'created' => true,
        'modified' => true,
        'validate_date' => true,
        'publish_date' => true,
        'created_by' => true,
        'validate_by' => true,
        'publish_by' => true,
        'region' => true,
        'department' => true,
        'town' => true,
        'domain' => true,
        'theme' => true,
        'mdc' => true,
        'mdvs' => true,
    ];
}
