<?= $this->Html->css('plugins/dataTables.bootstrap.css') ?>


<div class="content-box-large panel-info">
	<div class="panel-heading content-box-header">
		<div class="panel-title"><?= __('Filtre') ?></div>
	</div>
	<div class="panel-body" style="padding:0px">
		<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'class'=>'', 'url'=>['controller' => 'Mdvs', 'action' => 'index'])); ?>
		<?php echo $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Regions', 'action' => 'listesliees']), 'hidden' => true]); ?>
		<div class="col-xs-2">
			<?php 
				if($stType == 'CE') echo $this->Form->control('region_id', ['label'=>false, 'id'=>'region', 'onChange'=>'selectRegion();', 'class'=>'form-control input-sm', 'options' => $regions, 'empty'=>' -- Choisir la région dans la liste -- ']);
				else echo $this->Form->control('region_id', ['label'=>false, 'disabled'=>true, 'id'=>'region', 'onChange'=>'selectRegion();', 'class'=>'form-control input-sm', 'options' => $regions]);
			?>
		</div>
		<div class="col-xs-2">
			<?php
				if($stType == 'RE') echo $this->Form->control('department_id', ['label'=>false, 'id'=>'department', 'onChange'=>'selectDepartment()', 'class'=>'form-control input-sm', 'options' => $departments, 'empty'=>' -- Choisir la ville dans la liste -- ']);
				else echo $this->Form->control('department_id', ['label'=>false, 'disabled'=>true, 'id'=>'department', 'onChange'=>'selectDepartment()', 'class'=>'form-control input-sm', 'options' => $departments]);
			?>
		</div>
		<div class="col-xs-2">
			<?php
				if($stType == 'RE' || $stType == 'DE') echo $this->Form->control('town_id', ['label'=>false, 'id'=>'quater', 'class'=>'form-control input-sm', 'options' => $towns, 'empty'=>' -- Choisir l\'arrondissement dans la liste -- ']);
				else echo $this->Form->control('town_id', ['label'=>false, 'disabled'=>true, 'id'=>'town', 'class'=>'form-control input-sm', 'options' => $towns]);
			?>
		</div>
		<div class="col-xs-2">
			<?= $this->Form->control('mdvs_state', ['label'=>false, 'id'=>'state', 'class'=>'form-control input-sm', 'options' => '', 'empty'=>' -- Choisir le statut dans la liste -- ']); ?>
		</div>
		<div class="col-xs-4" style="text-align:right">
			<button type="submit" class="btn btn-primary"><?= __('Rechercher') ?></button>
		</div>
	</div>
</div>

<div class="content-box-large panel-info">
	<div class="panel-heading content-box-header">
		<div class="panel-title"><?= __('Gestion des microdonnées') ?></div>
	</div>
	<div class="panel-body" style="padding:0px">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
			<thead style="background-color:#faebcc;text-align:center;">
				<tr>
					<th scope="col" style="text-align:center;"><?= __('MICRODONNEES') ?></th>
					<th scope="col" style="text-align:center;"><?= __('VALEUR') ?></th>
					<th scope="col" style="text-align:center;"><?= __('SOURCE') ?></th>
					<th scope="col" style="text-align:center;"><?= __('UNITE') ?></th>
					<th scope="col" style="text-align:center;"><?= __('ACTIONS') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<=(sizeof($mds)-1);$i++){ ?>
					<?php if($mds[$i]['btn'] == 'M'){ ?>
						<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formEditMd'.$i)); ?>
							<tr>
								<td style="font-weight:bold;"><?php echo h($mds[$i]['md_name']); echo $this->Form->hidden('mdvs_value', ['id'=>'idMd'.$i, 'value' =>$mds[$i]['idMd']]); ?></td>
								<td><div class="" id="<?php echo 'colVal'.$i;  ?>"><?php echo $this->Form->control('mdvs_value',['label'=>false, 'value' =>$mds[$i]['mdValue'], 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$i, 'class'=>'form-control']); ?></div></td>
								<td><div class="" id="<?php echo 'colSrc'.$i;  ?>"><?php echo $this->Form->control('mdvs_source',['label'=>false, 'value' =>$mds[$i]['mdSource'], 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir la source', 'id'=>'srcMd'.$i, 'class'=>'form-control']); ?></div></td>
								<td><div class="" id="<?php echo 'colUni'.$i;  ?>"><?php echo $this->Form->control('mdvs_unite',['label'=>false, 'value' =>$mds[$i]['mdUnite'], 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir l\'unité', 'id'=>'uniMd'.$i, 'class'=>'form-control']); ?></div></td>
								<td>
									<button class="btn btn-primary btn-element btn-sm" type="button" onclick="modMd(<?php echo $i; ?>)" id="<?php echo 'btnMod'.$i; ?>"><?php echo __('Modifier'); ?></button>
									<button class="btn btn-primary btn-element btn-sm" type="button" onclick="delMd(<?php echo $i; ?>)" id="<?php echo 'btnDel'.$i; ?>"><?php echo __('Supprimer'); ?></button>
								</td>
							</tr>
						<?php echo $this->Form->end(); ?>
					<?php } ?>
					<?php if($mds[$i]['btn'] == 'C'){ ?>
						<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formEditMd'.$i)); ?>
						<tr>
							<td style="font-weight:bold;"><?php echo h($mds[$i]['md_name']); echo $this->Form->hidden('mdvs_value', ['id'=>'idMd'.$i, 'value' =>$mds[$i]['idMd']]); ?></td>
							<td><div class="hide" id="<?php echo 'colVal'.$i;  ?>"><?php echo $this->Form->control('mdvs_value',['label'=>false, 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$i, 'class'=>'form-control']); ?></div></td>
							<td><div class="hide" id="<?php echo 'colSrc'.$i;  ?>"><?php echo $this->Form->control('mdvs_source',['label'=>false, 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir la source', 'id'=>'srcMd'.$i, 'class'=>'form-control']); ?></div></td>
							<td><div class="hide" id="<?php echo 'colUni'.$i;  ?>"><?php echo $this->Form->control('mdvs_unite',['label'=>false, 'required'=>true, 'type'=>'text', 'placeholder' => 'Saisir l\'unité', 'id'=>'uniMd'.$i, 'class'=>'form-control']); ?></div></td>
							<td>
								<button class="btn btn-primary btn-element btn-sm" type="button" onclick="editMd(<?php echo $i; ?>)" id="<?php echo 'btnEditMd'.$i; ?>"><?php echo __('Éditer'); ?></button>
								<button class="btn btn-primary btn-element btn-sm hide" type="button" onclick="saveMd(<?php echo $i; ?>)" id="<?php echo 'btnSave'.$i; ?>"><?php echo __('Enregistrer'); ?></button>
								<button class="btn btn-primary btn-element btn-sm hide" type="button" onclick="cancelMd(<?php echo $i; ?>)" id="<?php echo 'btnCancel'.$i; ?>"><?php echo __('Annuler'); ?></button>
								<button class="btn btn-primary btn-element btn-sm hide" type="button" onclick="modMd(<?php echo $i; ?>)" id="<?php echo 'btnMod'.$i; ?>"><?php echo __('Modifier'); ?></button>
								<button class="btn btn-primary btn-element btn-sm hide" type="button" onclick="delMd(<?php echo $i; ?>)" id="<?php echo 'btnDel'.$i; ?>"><?php echo __('Supprimer'); ?></button>
							</td>
						</tr>
						<?php echo $this->Form->end(); ?>
					<?php } ?>			
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?= $this->Html->script('plugins/jquery.dataTables.min') ?>
<?= $this->Html->script('plugins/dataTables.bootstrap') ?>
<?= $this->Html->script('tables') ?>

<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<?php echo $this->Html->script('custom/select2.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/bootstrap-multiselect.min'); ?>
<script language="javascript">
	$(document).ready(function() {		
		
	});
	function saveMd(no) {
		saveMd_Next(no,"<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edition']); ?>");		
	}
	function modMd(no) {
		modMd_Next(no,"<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edit']); ?>"+"/"+$('#expID'+no).val());
	}
</script>
