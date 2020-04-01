<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theme $theme
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Theme'), ['action' => 'edit', $theme->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Theme'), ['action' => 'delete', $theme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $theme->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Themes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Theme'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Domains'), ['controller' => 'Domains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain'), ['controller' => 'Domains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="themes view large-9 meducm-8 columns content">
    <h3><?= h($theme->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Theme Name Fr') ?></th>
            <td><?= h($theme->theme_name_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme Name En') ?></th>
            <td><?= h($theme->theme_name_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme Abrev') ?></th>
            <td><?= h($theme->theme_abrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme Desc Fr') ?></th>
            <td><?= h($theme->theme_desc_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme Desc En') ?></th>
            <td><?= h($theme->theme_desc_en) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($theme->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme State') ?></th>
            <td><?= $this->Number->format($theme->theme_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($theme->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($theme->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($theme->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($theme->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Domains') ?></h4>
        <?php if (!empty($theme->domains)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Theme Id') ?></th>
                <th scope="col"><?= __('Domain Name Fr') ?></th>
                <th scope="col"><?= __('Domain Name En') ?></th>
                <th scope="col"><?= __('Domain Abrev') ?></th>
                <th scope="col"><?= __('Domain Desc Fr') ?></th>
                <th scope="col"><?= __('Domain Desc En') ?></th>
                <th scope="col"><?= __('Domain State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($theme->domains as $domains): ?>
            <tr>
                <td><?= h($domains->id) ?></td>
                <td><?= h($domains->theme_id) ?></td>
                <td><?= h($domains->domain_name_fr) ?></td>
                <td><?= h($domains->domain_name_en) ?></td>
                <td><?= h($domains->domain_abrev) ?></td>
                <td><?= h($domains->domain_desc_fr) ?></td>
                <td><?= h($domains->domain_desc_en) ?></td>
                <td><?= h($domains->domain_state) ?></td>
                <td><?= h($domains->created) ?></td>
                <td><?= h($domains->modified) ?></td>
                <td><?= h($domains->created_by) ?></td>
                <td><?= h($domains->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Domains', 'action' => 'view', $domains->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Domains', 'action' => 'edit', $domains->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Domains', 'action' => 'delete', $domains->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domains->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Indicators') ?></h4>
        <?php if (!empty($theme->indicators)): ?>
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
            <?php foreach ($theme->indicators as $indicators): ?>
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
        <?php if (!empty($theme->mdvs)): ?>
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
                <th scope="col"><?= __('Mdvs Value') ?></th>
                <th scope="col"><?= __('Mdvs Source') ?></th>
                <th scope="col"><?= __('Mdvs Unite') ?></th>
                <th scope="col"><?= __('Mdvs State') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($theme->mdvs as $mdvs): ?>
            <tr>
                <td><?= h($mdvs->id) ?></td>
                <td><?= h($mdvs->region_id) ?></td>
                <td><?= h($mdvs->department_id) ?></td>
                <td><?= h($mdvs->town_id) ?></td>
                <td><?= h($mdvs->domain_id) ?></td>
                <td><?= h($mdvs->theme_id) ?></td>
                <td><?= h($mdvs->mdc_id) ?></td>
                <td><?= h($mdvs->mdv_id) ?></td>
                <td><?= h($mdvs->mdvs_value) ?></td>
                <td><?= h($mdvs->mdvs_source) ?></td>
                <td><?= h($mdvs->mdvs_unite) ?></td>
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
