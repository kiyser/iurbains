<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mdv $mdv
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mdv->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mdv->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mdvs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Towns'), ['controller' => 'Towns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Town'), ['controller' => 'Towns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Domains'), ['controller' => 'Domains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain'), ['controller' => 'Domains', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Themes'), ['controller' => 'Themes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Theme'), ['controller' => 'Themes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mdcs'), ['controller' => 'Mdcs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mdc'), ['controller' => 'Mdcs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mdvs form large-9 meducm-8 columns content">
    <?= $this->Form->create($mdv) ?>
    <fieldset>
        <legend><?= __('Edit Mdv') ?></legend>
        <?php
            echo $this->Form->control('region_id', ['options' => $regions, 'empty' => true]);
            echo $this->Form->control('department_id', ['options' => $departments, 'empty' => true]);
            echo $this->Form->control('town_id', ['options' => $towns, 'empty' => true]);
            echo $this->Form->control('domain_id', ['options' => $domains, 'empty' => true]);
            echo $this->Form->control('theme_id', ['options' => $themes, 'empty' => true]);
            echo $this->Form->control('mdc_id', ['options' => $mdcs, 'empty' => true]);
            //echo $this->Form->control('mdv_id');
            echo $this->Form->control('mdvs_value');
            echo $this->Form->control('mdvs_source');
            echo $this->Form->control('mdvs_unite');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
