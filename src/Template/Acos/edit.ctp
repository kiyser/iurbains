<section class="content-header">
	<h1><?= __('ADMINISTRATION') ?><small><?= __('Modifier les permissions') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="row">
						<?= $this->Form->create(null, ['id' => 'formSearch', 'url' => ['controller' => 'Acos', 'action' => 'edit']]) ?>
						<div class="col-sm-4">
							<div class="form-group">
								<label><?= __('Groupe utilisateur') ?></label>
								<?= $this->Form->control('group_id', ['label' => false, 'id' => 'aro', 'onChange'=>'startSearch()', 'class' => 'form-control select2', 'options' => $groups]) ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label><?= __('Model') ?></label>
								<?= $this->Form->control('alias', ['label' => false, 'class' => 'form-control select2', 'options' => $models, 'empty' => '-- Sélectionner un model --']) ?>
							</div>
						</div>
						<div class="col-sm-3"style="margin-top:2.7%">
							<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-list"></i><?= __(' Afficher les permissions') ?></button>
						</div>
						<?= $this->Form->end() ?>
					</div>
				</div>
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-6"></div>
							<div class="col-sm-6"></div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
									<thead>
										<tr role="row" style="background-color:#ECF0F5">
											<th scope="col" style="width:25%;"><?= __('Nom du contrôleur') ?></th>
											<th scope="col"><?= __('Nom de l\'action') ?></th>
											<th scope="col" class="actions" style="width:18%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php for($i=0;$i<sizeof($tables);$i++){  ?> 	
											<?php if(isset($tables[$i])) for($j=0;$j<sizeof($tables[$i]);$j++){ ?>
												<?php if($j==0){ ?>
													<tr>
														<td rowspan=<?php echo sizeof($tables[$i]); ?> style="vertical-align:middle"><?= $tables[$i][$j]['controller'] ?></td>
														<td><?= $tables[$i][$j]['action'] ?></td>
														<td class="actions" style="text-align:center">
															<div class="btn-group">
																<?php if($tables[$i][$j]['permission'] == true){  ?><button class="btn btn-xs btn-success" onclick="setPermission('<?php echo $tables[$i][$j]['controller']; ?>', '<?php echo $tables[$i][$j]['action']; ?>', 'deny')" id="<?php echo 'btnAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"><i class="fa fa-check" id="<?php echo 'faAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"></i></button><?php } ?>
																<?php if($tables[$i][$j]['permission'] == false){  ?><a class="btn btn-xs btn-danger" onclick="setPermission('<?php echo $tables[$i][$j]['controller']; ?>', '<?php echo $tables[$i][$j]['action']; ?>', 'allow')" id="<?php echo 'btnDeny'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"><i class="fa fa-times" id="<?php echo 'faAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"></i></a><?php } ?>
															</div>
														</td>
													</tr>
												<?php }else{ ?>
													<tr>
														<td><?= $tables[$i][$j]['action'] ?></td>
														<td class="actions" style="text-align:center">
															<div class="btn-group">
																<?php if($tables[$i][$j]['permission'] == true){  ?><button class="btn btn-xs btn-success" onclick="setPermission('<?php echo $tables[$i][$j]['controller']; ?>', '<?php echo $tables[$i][$j]['action']; ?>', 'deny')" id="<?php echo 'btnAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"><i class="fa fa-check" id="<?php echo 'faAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"></i></button><?php } ?>
																<?php if($tables[$i][$j]['permission'] == false){  ?><a class="btn btn-xs btn-danger" onclick="setPermission('<?php echo $tables[$i][$j]['controller']; ?>', '<?php echo $tables[$i][$j]['action']; ?>', 'allow')" id="<?php echo 'btnDeny'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"><i class="fa fa-times" id="<?php echo 'faAllow'.$tables[$i][$j]['controller'].$tables[$i][$j]['action']; ?>"></i></a><?php } ?>
															</div>
														</td>
													</tr>
												<?php } ?>											
											<?php } ?>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<script language="javascript">
	$(document).ready(function() {
		//Initialize Select2 Elements
		$('.select2').select2()
	});
	function setPermission(controller, action, acl) {
		setPermission_Next(controller, action, acl,"<?php echo $this->Url->build(['controller' => 'Acos', 'action' => 'permission']); ?>");
	}
</script>
