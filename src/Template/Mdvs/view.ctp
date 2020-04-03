<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mdv $mdv
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mdv'), ['action' => 'edit', $mdv->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mdv'), ['action' => 'delete', $mdv->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mdv->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Towns'), ['controller' => 'Towns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Town'), ['controller' => 'Towns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Domains'), ['controller' => 'Domains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain'), ['controller' => 'Domains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Themes'), ['controller' => 'Themes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Theme'), ['controller' => 'Themes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdcs'), ['controller' => 'Mdcs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdc'), ['controller' => 'Mdcs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mdvs view large-9 meducm-8 columns content">
    <h3><?= h($mdv->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= $mdv->has('region') ? $this->Html->link($mdv->region->id, ['controller' => 'Regions', 'action' => 'view', $mdv->region->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $mdv->has('department') ? $this->Html->link($mdv->department->id, ['controller' => 'Departments', 'action' => 'view', $mdv->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Town') ?></th>
            <td><?= $mdv->has('town') ? $this->Html->link($mdv->town->id, ['controller' => 'Towns', 'action' => 'view', $mdv->town->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domain') ?></th>
            <td><?= $mdv->has('domain') ? $this->Html->link($mdv->domain->id, ['controller' => 'Domains', 'action' => 'view', $mdv->domain->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme') ?></th>
            <td><?= $mdv->has('theme') ? $this->Html->link($mdv->theme->id, ['controller' => 'Themes', 'action' => 'view', $mdv->theme->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdc') ?></th>
            <td><?= $mdv->has('mdc') ? $this->Html->link($mdv->mdc->id, ['controller' => 'Mdcs', 'action' => 'view', $mdv->mdc->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdvs Name Fr') ?></th>
            <td><?= h($mdv->mdvs_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdvs Name En') ?></th>
            <td><?= h($mdv->mdvs_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdvs Desc Fr') ?></th>
            <td><?= h($mdv->mdvs_desc_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdvs Desc En') ?></th>
            <td><?= h($mdv->mdvs_desc_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mdv->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdv Id') ?></th>
            <td><?= $this->Number->format($mdv->mdv_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdvs State') ?></th>
            <td><?= $this->Number->format($mdv->mdvs_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($mdv->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($mdv->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mdv->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mdv->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mdvs') ?></h4>
        <?php if (!empty($mdv->mdvs)): ?>
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
            <?php foreach ($mdv->mdvs as $mdvs): ?>
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
        <h4><?= __('Related Indicators') ?></h4>
        <?php if (!empty($mdv->indicators)): ?>
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
            <?php foreach ($mdv->indicators as $indicators): ?>
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
</div>
