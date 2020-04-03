<?= $this->Html->css('others/multi-select.css') ?>
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
							<div class="col-xs-3"></div>
							<div class="col-xs-6">							
								<div class="form-group">
									<label><?= __('Intitulé de l\'indicateur') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('indicator_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control input-sm', 'type' => 'text', 'placeholder' => 'Indicateur']) ?>
									<?= $this->Form->hidden('indicator_calcul', ['label' => false, 'hidden' => true, 'type' => 'text', 'id' => 'calcul']) ?>
									<?= $this->Form->hidden('indicator_desc_fr', ['label' => false, 'hidden' => true, 'type' => 'text', 'id' => 'description']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Thème') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'id'=>'theme', 'onchange'=>'selectDomain()', 'aria-hidden'=>'true', 'style'=>'width: 100%;', 'class' => 'form-control select2', 'options' => $themes, 'empty' => '-- Sélectionner un thème --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Domaine') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('domain_id', ['label' => false, 'required' => true, 'id'=>'domain', 'onchange'=>'', 'aria-hidden'=>'true', 'style'=>'width: 100%;', 'class' => 'form-control select2', 'options' => $domains, 'empty' => '-- Sélectionner un domaine --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Microdonnée') ?></label>
									<?= $this->Form->control('mdc_id', ['label' => false, 'id'=>'mdc', 'onchange'=>'onSelectMdc()', 'aria-hidden'=>'true', 'style'=>'width: 100%;', 'class' => 'form-control select2', 'options' => $mdcs, 'empty' => '-- Sélectionner la microdonnée --']) ?>
								</div>
								<div class="form-group col-xs-5" style="padding-left:0px">
									<label><?= __('Opérande') ?></label>
									<?= $this->Form->control('operand_id', ['label' => false, 'id'=>'operand', 'onchange'=>'onSelectOperand()', 'aria-hidden'=>'true', 'style'=>'width: 100%;', 'class' => 'form-control select2', 'options' => $operands, 'empty' => '-- Sélectionner --']) ?>
								</div>
								<div class="form-group col-xs-5">
									<label><?= __('Coéficient') ?></label>
									<?= $this->Form->control('variable', ['label' => false, 'class' => 'form-control input-sm', 'id' => 'variable', 'type' => 'text', 'placeholder' => 'Saisir une variable']) ?>
								</div>
								<div class="form-group col-xs-2 pull-right" style="padding-right:0px">
									<button type="button" class="btn btn-primary btn-sm pull-right" style="margin-top:25px;" onclick="addVariable()"><i class="fa fa-arrow-down"></i><?= __(' Ajouter') ?></button>
								</div>						
								<div class="col-xs-12" style="padding-left:0px;padding-right:0px">
									<div class="box box-success">
										<div class="box-body">
											<?= $this->Form->control('description', ['label' => false, 'disabled' => true, 'class' => 'form-control input-sm', 'type' => 'textarea', 'style' => 'height:100px;border:0px;background-color:#fff;resize:none', 'id' => 'formule']) ?>
											<button type="button" class="btn btn-success btn-sm pull-right" onclick="verifierExp()"><i class="fa fa-check"></i><?= __(' Vérifier l\'expression') ?></button>
											<button type="button" class="btn btn-primary btn-sm" onclick="reinitialise()"><i class="fa fa-refresh"></i><?= __(' Réinitialiser') ?></button>
										</div>
									</div>
								</div>
								<div class="col-xs-4"></div>						
							</div>
							<div class="col-xs-3"></div>				
						</div>
					</div>					
					<div class="box-footer">
						<div class="col-xs-3"></div>	
						<div class="col-xs-6"><button type="submit" class="btn btn-primary pull-right hide" id="btnSave"><i class="fa fa-save"></i><?= __(' Sauvegarder') ?></button></div>
						<div class="col-xs-3"></div>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</section>
<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery-ui.min') ?>
<?= $this->Html->script('custom/utils') ?>
<style>
	.icheckbox_flat-blue, .iradio_flat-blue{
		height:15px;
		width:15px;
	}
</style>
<script language="javascript">	
	$(document).ready(function() {
		$('.select2').select2();
	});
	var formule = [];
	var calcul = [];
	var index = 0;
	function reinitialise(){
		formule = [];
		calcul = [];
		index = 0;
		$("#btnSave").addClass('hide');
		$('#calcul').val("");
		$('#formule').val("");
		$('#variable').val("");
	}	
	function addVariable(){
		formule[index] = 'V|'+$('#variable').val();
		calcul[index] = 'V|'+$('#variable').val();
		$("#formule").val($("#formule").val()+$('#variable').val());
		index++;
	}	
	function onSelectMdc(){
		formule[index] = 'M|'+$('#mdc').val().split("||")[1];
		calcul[index] = 'M|'+$('#mdc').val().split("||")[0];
		$("#formule").val($("#formule").val()+$('#mdc').val().split("||")[1]);
		index++;
	}	
	function onSelectOperand(){
		formule[index] = 'O|'+$('#operand').val().split("||")[1];
		calcul[index] = 'O|'+$('#operand').val().split("||")[0];
		$("#formule").val($("#formule").val()+$('#operand').val().split("||")[1]);
		index++;
	}	
	function verifierExp(){
		nbreParentheses = 0;
		errorParentheses = 0;
		errorFormule = 0;
		indicator = description = '';
		for(i=0;i<formule.length;i++){
			if(i == 0 && (formule[i].split("|")[1]==')' || formule[i].split("|")[1]=='+' || formule[i].split("|")[1]=='-' || formule[i].split("|")[1]=='*' || formule[i].split("|")[1]=='/')) errorFormule = 1;
			if(formule[i].split("|")[1]=='(') nbreParentheses ++;
			if(formule[i].split("|")[1]==')') nbreParentheses --;
			indicator = indicator + calcul[i]+':';
			description = description + formule[i].split("|")[1];
		}
		if(errorFormule!=0 || nbreParentheses!=0){
			alert('Expression mal formée');
			$("#btnSave").addClass('hide');
		}
		else {
			alert('Expression bien formée');
			$("#btnSave").removeClass('hide');
			$('#calcul').val(indicator);
			$('#description').val(description);
		}
		//alert($("#formule").val());	alert($("#calcul").val());
	}	
</script>