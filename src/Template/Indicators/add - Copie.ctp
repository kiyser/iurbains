<?= $this->Html->css('others/blue.css') ?>
<section class="content-header">
	<h1><?= __('GESTION DES INDICATEURS') ?><small><?= __('Ajouter un indicateur') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($indicator) ?>
					<?= $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-5">
								<div class="form-group">
									<label><?= __('Intitulé de l\'indicateur') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('indicator_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control input-sm', 'type' => 'text', 'placeholder' => 'Indicateur']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Description de l\'indicateur') ?></label>
									<?= $this->Form->control('indicator_desc_fr', ['label' => false, 'class' => 'form-control input-sm', 'type' => 'textarea', 'rows' => '2']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Thème') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'id'=>'theme', 'onChange'=>'selectDomain();', 'class' => 'form-control select2 input-sm', 'options' => $themes, 'empty' => '-- Sélectionner le thème --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Domaine') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('domain_id', ['label' => false, 'required' => true, 'id'=>'domain', 'class' => 'form-control select2 input-sm', 'options' => $domains, 'empty' => '-- Sélectionner le domaine --']) ?>
								</div>
							</div>
							<div class="col-xs-7" style="height:300px;overflow:scroll">
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped" id="mdcTable">
										<tbody>
											<?php foreach ($mdcs as $mdc): ?>
											<tr>
												<td><input type="checkbox" class="icheckbox_flat-blue" onclick="selectMdc(<?php echo $mdc->id; ?>);" id="<?php echo 'mdcLine'.$mdc->id; ?>"></td>
												<td><?php echo $mdc->mdcs_name_fr;echo $this->Form->hidden('mdc_id', ['id'=>'mdcName'.$mdc->id, 'value' =>$mdc->mdcs_name_fr]); ?></td>
												<td style="width:5px;">
													<?php if($mdc->mdcs_state == 2){ ?>
													<button class="btn btn-success btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Publiée'); ?></button>
													<?php } else { ?>
													<button class="btn btn-default btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Créée'); ?></button>
													<?php } ?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
					<div class="box-footer">
						<div class="col-xs-10">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-envelope-o"></i></span>
								<div class="info-box-content">									
									<?= $this->Form->control('indicator_calcul', ['label' => false, 'id' => 'formule', 'class' => 'form-control input-sm', 'data-inputmask' => "'mask': ['999999999']", 'data-mask' => '', 'type' => 'textarea', 'rows' => '1']) ?>
								</div><button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-refresh"></i><?= __(' Vérifier l\'expression') ?></button>
							</div>
						</div>
						<div class="col-xs-2"><button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i><?= __(' Sauvegarder') ?></button></div>
					
					
					<select id='pre-selected-options' multiple='multiple'>
						<option value='elem_1' selected>elem 1</option>
						<option value='elem_2'>elem 2</option>
						<option value='elem_3'>elem 3</option>
						<option value='elem_4' selected>elem 4</option>
						...
						<option value='elem_100'>elem 100</option>
					</select>
					
					
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</section>
<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('others/jquery.multi-select'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<style>
	.icheckbox_flat-blue, .iradio_flat-blue{
		height:15px;
		width:15px;
	}
</style>
<script language="javascript">
	$('#pre-selected-options').multiSelect();
	$(document).ready(function() {
		$('.select2').select2();
	});
	function selectMdc(id){
		alert(document.getElementById("mdcLine"+id).value);
		formule = $('#formule').val();
		$('#formule').val(formule+$('#mdcName'+id).val());
	}
</script>