<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inspector Entity
 *
 * @property int $id
 * @property string $model_name
 * @property string $controller_action
 * @property int|null $data_id
 * @property string|null $guest_system
 * @property string|null $guest_browser
 * @property string|null $guest_ip
 * @property string|null $guest_lat
 * @property string|null $guest_long
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int|null $created_by
 *
 * @property \App\Model\Entity\Data $data
 */
class Inspector extends Entity
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
        'model_name' => true,
        'controller_action' => true,
        'id_data' => true,
        'guest_system' => true,
        'guest_browser' => true,
        'guest_ip' => true,
        'guest_lat' => true,
        'guest_long' => true,
        'created' => true,
        'created_by' => true,
        'data' => true
    ];
}
