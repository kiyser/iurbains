<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Structure $structure
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Structure'), ['action' => 'edit', $structure->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Structure'), ['action' => 'delete', $structure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $structure->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Structures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Structure'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sts'), ['controller' => 'Sts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New St'), ['controller' => 'Sts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Towns'), ['controller' => 'Towns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Town'), ['controller' => 'Towns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="structures view large-9 meducm-8 columns content">
    <h3><?= h($structure->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('St') ?></th>
            <td><?= $structure->has('st') ? $this->Html->link($structure->st->id, ['controller' => 'Sts', 'action' => 'view', $structure->st->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= $structure->has('region') ? $this->Html->link($structure->region->id, ['controller' => 'Regions', 'action' => 'view', $structure->region->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $structure->has('department') ? $this->Html->link($structure->department->id, ['controller' => 'Departments', 'action' => 'view', $structure->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Town') ?></th>
            <td><?= $structure->has('town') ? $this->Html->link($structure->town->id, ['controller' => 'Towns', 'action' => 'view', $structure->town->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure Name Fr') ?></th>
            <td><?= h($structure->structure_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure Name En') ?></th>
            <td><?= h($structure->structure_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure Abrev') ?></th>
            <td><?= h($structure->structure_abrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure Desc Fr') ?></th>
            <td><?= h($structure->structure_desc_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure Desc En') ?></th>
            <td><?= h($structure->structure_desc_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($structure->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Structure State') ?></th>
            <td><?= $this->Number->format($structure->structure_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($structure->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($structure->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($structure->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($structure->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($structure->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Group Id') ?></th>
                <th scope="col"><?= __('Structure Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Statut') ?></th>
                <th scope="col"><?= __('Civilite') ?></th>
                <th scope="col"><?= __('Portable') ?></th>
                <th scope="col"><?= __('Adresse') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Activate Date') ?></th>
                <th scope="col"><?= __('Activate By') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($structure->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->group_id) ?></td>
                <td><?= h($users->structure_id) ?></td>
                <td><?= h($users->country_id) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->statut) ?></td>
                <td><?= h($users->civilite) ?></td>
                <td><?= h($users->portable) ?></td>
                <td><?= h($users->adresse) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->activate_date) ?></td>
                <td><?= h($users->activate_by) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->created_by) ?></td>
                <td><?= h($users->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
