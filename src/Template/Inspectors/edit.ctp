<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inspector $inspector
 */
?>
<nav class="large-3 meducm-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $inspector->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $inspector->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Inspectors'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="inspectors form large-9 meducm-8 columns content">
    <?= $this->Form->create($inspector) ?>
    <fieldset>
        <legend><?= __('Edit Inspector') ?></legend>
        <?php
            echo $this->Form->control('model_name');
            echo $this->Form->control('controller_action');
            echo $this->Form->control('data_id');
            echo $this->Form->control('guest_system');
            echo $this->Form->control('guest_browser');
            echo $this->Form->control('guest_ip');
            echo $this->Form->control('guest_lat');
            echo $this->Form->control('guest_long');
            echo $this->Form->control('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
