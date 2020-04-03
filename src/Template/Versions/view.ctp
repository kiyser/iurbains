<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Version $version
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Version'), ['action' => 'edit', $version->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Version'), ['action' => 'delete', $version->id], ['confirm' => __('Are you sure you want to delete # {0}?', $version->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Versions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Version'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="versions view large-9 medium-8 columns content">
    <h3><?= h($version->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Version Name Fr') ?></th>
            <td><?= h($version->version_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version Name En') ?></th>
            <td><?= h($version->version_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($version->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version Year') ?></th>
            <td><?= $this->Number->format($version->version_year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version State') ?></th>
            <td><?= $this->Number->format($version->version_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($version->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($version->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version Dd') ?></th>
            <td><?= h($version->version_dd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version Df') ?></th>
            <td><?= h($version->version_df) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($version->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($version->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mdvs') ?></h4>
        <?php if (!empty($version->mdvs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Town Id') ?></th>
                <th scope="col"><?= __('Mdc Id') ?></th>
                <th scope="col"><?= __('Mdv Id') ?></th>
                <th scope="col"><?= __('Mdvs Value') ?></th>
                <th scope="col"><?= __('Mdvs Source') ?></th>
                <th scope="col"><?= __('Mdvs Unite') ?></th>
                <th scope="col"><?= __('Mdvs State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Validate Date') ?></th>
                <th scope="col"><?= __('Publish Date') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Validate By') ?></th>
                <th scope="col"><?= __('Publish By') ?></th>
                <th scope="col"><?= __('Version Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($version->mdvs as $mdvs): ?>
            <tr>
                <td><?= h($mdvs->id) ?></td>
                <td><?= h($mdvs->region_id) ?></td>
                <td><?= h($mdvs->department_id) ?></td>
                <td><?= h($mdvs->town_id) ?></td>
                <td><?= h($mdvs->mdc_id) ?></td>
                <td><?= h($mdvs->mdv_id) ?></td>
                <td><?= h($mdvs->mdvs_value) ?></td>
                <td><?= h($mdvs->mdvs_source) ?></td>
                <td><?= h($mdvs->mdvs_unite) ?></td>
                <td><?= h($mdvs->mdvs_state) ?></td>
                <td><?= h($mdvs->created) ?></td>
                <td><?= h($mdvs->modified) ?></td>
                <td><?= h($mdvs->validate_date) ?></td>
                <td><?= h($mdvs->publish_date) ?></td>
                <td><?= h($mdvs->created_by) ?></td>
                <td><?= h($mdvs->validate_by) ?></td>
                <td><?= h($mdvs->publish_by) ?></td>
                <td><?= h($mdvs->version_id) ?></td>
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
