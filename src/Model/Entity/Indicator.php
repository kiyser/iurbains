<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Indicator Entity
 *
 * @property int $id
 * @property int|null $domain_id
 * @property int|null $theme_id
 * @property int|null $mdc_id
 * @property string $indicator_name_fr
 * @property string|null $indicator_name_en
 * @property string|null $indicator_desc_fr
 * @property string|null $indicator_desc_en
 * @property int|null $indicator_state
 * @property int|null $indicator_agregat
 * @property int $indicator_unite
 * @property string $indicator_calcul
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Town $town
 * @property \App\Model\Entity\Domain $domain
 * @property \App\Model\Entity\Theme $theme
 * @property \App\Model\Entity\Mdv $mdv
 * @property \App\Model\Entity\Indicator[] $indicators
 */
class Indicator extends Entity
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
        'domain_id' => true,
        'theme_id' => true,
        'mdc_id' => true,
        'indicator_name_fr' => true,
        'indicator_name_en' => true,
        'indicator_desc_fr' => true,
        'indicator_desc_en' => true,
        'indicator_state' => true,
        'indicator_agregat' => true,
        'indicator_unite' => true,
        'indicator_calcul' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'region' => true,
        'department' => true,
        'town' => true,
        'domain' => true,
        'theme' => true,
        'mdv' => true,
        'indicators' => true
    ];
}
