<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Structures'), ['controller' => 'Structures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Structure'), ['controller' => 'Structures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Towns'), ['controller' => 'Towns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Town'), ['controller' => 'Towns', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 meducm-8 columns content">
    <h3><?= h($department->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= $department->has('region') ? $this->Html->link($department->region->id, ['controller' => 'Regions', 'action' => 'view', $department->region->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Name Fr') ?></th>
            <td><?= h($department->department_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Name En') ?></th>
            <td><?= h($department->department_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department City') ?></th>
            <td><?= h($department->department_city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department State') ?></th>
            <td><?= $this->Number->format($department->department_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($department->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($department->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($department->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($department->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Indicators') ?></h4>
        <?php if (!empty($department->indicators)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Town Id') ?></th>
                <th scope="col"><?= __('Domain Id') ?></th>
                <th scope="col"><?= __('Theme Id') ?></th>
                <th scope="col"><?= __('Mdv Id') ?></th>
                <th scope="col"><?= __('Indicator Id') ?></th>
                <th scope="col"><?= __('Indicator Name Fr') ?></th>
                <th scope="col"><?= __('Indicator Name En') ?></th>
                <th scope="col"><?= __('Indicator Desc Fr') ?></th>
                <th scope="col"><?= __('Indicator Desc En') ?></th>
                <th scope="col"><?= __('Indicator State') ?></th>
                <th scope="col"><?= __('Indicator Agregat') ?></th>
                <th scope="col"><?= __('Indicator Unite') ?></th>
                <th scope="col"><?= __('Indicator Calcul') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->indicators as $indicators): ?>
            <tr>
                <td><?= h($indicators->id) ?></td>
                <td><?= h($indicators->region_id) ?></td>
                <td><?= h($indicators->department_id) ?></td>
                <td><?= h($indicators->town_id) ?></td>
                <td><?= h($indicators->domain_id) ?></td>
                <td><?= h($indicators->theme_id) ?></td>
                <td><?= h($indicators->mdv_id) ?></td>
                <td><?= h($indicators->indicator_id) ?></td>
                <td><?= h($indicators->indicator_name_fr) ?></td>
                <td><?= h($indicators->indicator_name_en) ?></td>
                <td><?= h($indicators->indicator_desc_fr) ?></td>
                <td><?= h($indicators->indicator_desc_en) ?></td>
                <td><?= h($indicators->indicator_state) ?></td>
                <td><?= h($indicators->indicator_agregat) ?></td>
                <td><?= h($indicators->indicator_unite) ?></td>
                <td><?= h($indicators->indicator_calcul) ?></td>
                <td><?= h($indicators->created) ?></td>
                <td><?= h($indicators->modified) ?></td>
                <td><?= h($indicators->created_by) ?></td>
                <td><?= h($indicators->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Indicators', 'action' => 'view', $indicators->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Indicators', 'action' => 'edit', $indicators->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Indicators', 'action' => 'delete', $indicators->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicators->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Mdvs') ?></h4>
        <?php if (!empty($department->mdvs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Town Id') ?></th>
                <th scope="col"><?= __('Domain Id') ?></th>
                <th scope="col"><?= __('Theme Id') ?></th>
                <th scope="col"><?= __('Mdc Id') ?></th>
                <th scope="col"><?= __('Mdv Id') ?></th>
                <th scope="col"><?= __('Mdvs Name Fr') ?></th>
                <th scope="col"><?= __('Mdvs Name En') ?></th>
                <th scope="col"><?= __('Mdvs Desc Fr') ?></th>
                <th scope="col"><?= __('Mdvs Desc En') ?></th>
                <th scope="col"><?= __('Mdvs State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->mdvs as $mdvs): ?>
            <tr>
                <td><?= h($mdvs->id) ?></td>
                <td><?= h($mdvs->region_id) ?></td>
                <td><?= h($mdvs->department_id) ?></td>
                <td><?= h($mdvs->town_id) ?></td>
                <td><?= h($mdvs->domain_id) ?></td>
                <td><?= h($mdvs->theme_id) ?></td>
                <td><?= h($mdvs->mdc_id) ?></td>
                <td><?= h($mdvs->mdv_id) ?></td>
                <td><?= h($mdvs->mdvs_name_fr) ?></td>
                <td><?= h($mdvs->mdvs_name_en) ?></td>
                <td><?= h($mdvs->mdvs_desc_fr) ?></td>
                <td><?= h($mdvs->mdvs_desc_en) ?></td>
                <td><?= h($mdvs->mdvs_state) ?></td>
                <td><?= h($mdvs->created) ?></td>
                <td><?= h($mdvs->modified) ?></td>
                <td><?= h($mdvs->created_by) ?></td>
                <td><?= h($mdvs->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Mdvs', 'action' => 'view', $mdvs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Mdvs', 'action' => 'edit', $mdvs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Mdvs', 'action' => 'delete', $mdvs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mdvs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Structures') ?></h4>
        <?php if (!empty($department->structures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('St Id') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Town Id') ?></th>
                <th scope="col"><?= __('Structure Name Fr') ?></th>
                <th scope="col"><?= __('Structure Name En') ?></th>
                <th scope="col"><?= __('Structure Abrev') ?></th>
                <th scope="col"><?= __('Structure Desc Fr') ?></th>
                <th scope="col"><?= __('Structure Desc En') ?></th>
                <th scope="col"><?= __('Structure State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->structures as $structures): ?>
            <tr>
                <td><?= h($structures->id) ?></td>
                <td><?= h($structures->st_id) ?></td>
                <td><?= h($structures->region_id) ?></td>
                <td><?= h($structures->department_id) ?></td>
                <td><?= h($structures->town_id) ?></td>
                <td><?= h($structures->structure_name_fr) ?></td>
                <td><?= h($structures->structure_name_en) ?></td>
                <td><?= h($structures->structure_abrev) ?></td>
                <td><?= h($structures->structure_desc_fr) ?></td>
                <td><?= h($structures->structure_desc_en) ?></td>
                <td><?= h($structures->structure_state) ?></td>
                <td><?= h($structures->created) ?></td>
                <td><?= h($structures->modified) ?></td>
                <td><?= h($structures->created_by) ?></td>
                <td><?= h($structures->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Structures', 'action' => 'view', $structures->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Structures', 'action' => 'edit', $structures->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Structures', 'action' => 'delete', $structures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $structures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Towns') ?></h4>
        <?php if (!empty($department->towns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Town Name Fr') ?></th>
                <th scope="col"><?= __('Town Name En') ?></th>
                <th scope="col"><?= __('Town City') ?></th>
                <th scope="col"><?= __('Town State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->towns as $towns): ?>
            <tr>
                <td><?= h($towns->id) ?></td>
                <td><?= h($towns->department_id) ?></td>
                <td><?= h($towns->town_name_fr) ?></td>
                <td><?= h($towns->town_name_en) ?></td>
                <td><?= h($towns->town_city) ?></td>
                <td><?= h($towns->town_state) ?></td>
                <td><?= h($towns->created) ?></td>
                <td><?= h($towns->modified) ?></td>
                <td><?= h($towns->created_by) ?></td>
                <td><?= h($towns->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Towns', 'action' => 'view', $towns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Towns', 'action' => 'edit', $towns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Towns', 'action' => 'delete', $towns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $towns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
