<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mdc $mdc
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mdc'), ['action' => 'edit', $mdc->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mdc'), ['action' => 'delete', $mdc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mdc->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mdcs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdc'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mdcs view large-9 meducm-8 columns content">
    <h3><?= h($mdc->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mdcs Name Fr') ?></th>
            <td><?= h($mdc->mdcs_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdcs Name En') ?></th>
            <td><?= h($mdc->mdcs_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdcs Desc Fr') ?></th>
            <td><?= h($mdc->mdcs_desc_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdcs Desc En') ?></th>
            <td><?= h($mdc->mdcs_desc_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mdc->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mdcs State') ?></th>
            <td><?= $this->Number->format($mdc->mdcs_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($mdc->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($mdc->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mdc->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mdc->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mdvs') ?></h4>
        <?php if (!empty($mdc->mdvs)): ?>
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
            <?php foreach ($mdc->mdvs as $mdvs): ?>
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
</div>
