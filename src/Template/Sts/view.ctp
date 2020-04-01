<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\St $st
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit St'), ['action' => 'edit', $st->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete St'), ['action' => 'delete', $st->id], ['confirm' => __('Are you sure you want to delete # {0}?', $st->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New St'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Structures'), ['controller' => 'Structures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Structure'), ['controller' => 'Structures', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sts view large-9 meducm-8 columns content">
    <h3><?= h($st->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sts Name Fr') ?></th>
            <td><?= h($st->sts_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts Name En') ?></th>
            <td><?= h($st->sts_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts Abrev') ?></th>
            <td><?= h($st->sts_abrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts Desc Fr') ?></th>
            <td><?= h($st->sts_desc_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts Desc En') ?></th>
            <td><?= h($st->sts_desc_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($st->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts State') ?></th>
            <td><?= $this->Number->format($st->sts_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($st->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($st->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($st->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($st->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Structures') ?></h4>
        <?php if (!empty($st->structures)): ?>
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
            <?php foreach ($st->structures as $structures): ?>
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
</div>
