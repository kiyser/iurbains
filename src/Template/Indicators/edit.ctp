<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Indicator $indicator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $indicator->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $indicator->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Indicators'), ['action' => 'index']) ?></li>
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
        <li><?= $this->Html->link(__('List Mdvs'), ['controller' => 'Mdvs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mdv'), ['controller' => 'Mdvs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="indicators form large-9 medium-8 columns content">
    <?= $this->Form->create($indicator) ?>
    <fieldset>
        <legend><?= __('Edit Indicator') ?></legend>
        <?php
            echo $this->Form->control('domain_id', ['options' => $domains, 'empty' => true]);
            echo $this->Form->control('theme_id', ['options' => $themes, 'empty' => true]);
            echo $this->Form->control('mdc_id');
            echo $this->Form->control('indicator_name_fr');
            echo $this->Form->control('indicator_name_en');
            echo $this->Form->control('indicator_desc_fr');
            echo $this->Form->control('indicator_desc_en');
            echo $this->Form->control('indicator_state');
            echo $this->Form->control('indicator_agregat');
            echo $this->Form->control('indicator_unite');
            echo $this->Form->control('indicator_calcul');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
