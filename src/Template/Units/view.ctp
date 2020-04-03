<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="units view large-9 medium-8 columns content">
    <h3><?= h($unit->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Unit Name Fr') ?></th>
            <td><?= h($unit->unit_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Name En') ?></th>
            <td><?= h($unit->unit_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Abrev') ?></th>
            <td><?= h($unit->unit_abrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($unit->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit State') ?></th>
            <td><?= $this->Number->format($unit->unit_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($unit->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($unit->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($unit->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($unit->modified) ?></td>
        </tr>
    </table>
</div>
