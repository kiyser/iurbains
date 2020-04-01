<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operand $operand
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Operand'), ['action' => 'edit', $operand->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Operand'), ['action' => 'delete', $operand->id], ['confirm' => __('Are you sure you want to delete # {0}?', $operand->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Operands'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Operand'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="operands view large-9 medium-8 columns content">
    <h3><?= h($operand->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Operand Name Fr') ?></th>
            <td><?= h($operand->operand_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operand Name En') ?></th>
            <td><?= h($operand->operand_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operand Abrev') ?></th>
            <td><?= h($operand->operand_abrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operand Symbol') ?></th>
            <td><?= h($operand->operand_symbol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($operand->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operand State') ?></th>
            <td><?= $this->Number->format($operand->operand_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($operand->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($operand->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($operand->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($operand->modified) ?></td>
        </tr>
    </table>
</div>
