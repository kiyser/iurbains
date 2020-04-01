<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inspector $inspector
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inspector'), ['action' => 'edit', $inspector->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inspector'), ['action' => 'delete', $inspector->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inspector->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inspectors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inspector'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inspectors view large-9 meducm-8 columns content">
    <h3><?= h($inspector->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Model Name') ?></th>
            <td><?= h($inspector->model_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Controller Action') ?></th>
            <td><?= h($inspector->controller_action) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest System') ?></th>
            <td><?= h($inspector->guest_system) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest Browser') ?></th>
            <td><?= h($inspector->guest_browser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest Ip') ?></th>
            <td><?= h($inspector->guest_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest Lat') ?></th>
            <td><?= h($inspector->guest_lat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest Long') ?></th>
            <td><?= h($inspector->guest_long) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inspector->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Id') ?></th>
            <td><?= $this->Number->format($inspector->data_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($inspector->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($inspector->created) ?></td>
        </tr>
    </table>
</div>
