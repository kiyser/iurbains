<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('ADMINISTRATION') ?><small><?= __('Liste des actions') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-3">
							<?= $this->Form->create(null) ?>
							<?= $this->Form->control('alias', ['label' => false, 'required' => true, 'class' => 'form-control input-sm', 'options' => $controllers, 'empty' => '-- Sélectionner un model --']) ?>
						</div>
						<div class="col-sm-3"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i><?= __(' Rechercher') ?></button></div>
						<?= $this->Form->end() ?>
						<div class="col-sm-3 pull-right">
							<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Acos', 'action' => 'index']) ?>"><i class="fa fa-refresh"></i><?= __(' Actualiser') ?></a>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
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
										<?php for($i=0;$i<sizeof($acos);$i++){  ?> 
											<?php if(isset($acos[$i])) for($j=0;$j<sizeof($acos[$i]);$j++){ ?>
												<?php if($j==0){ ?>
													<tr>
														<td rowspan=<?php echo sizeof($acos[$i]); ?> style="vertical-align:middle"><?= $acos[$i][$j]['controller'] ?></td>
														<td><?= $acos[$i][$j]['action'] ?></td>
														<td class="actions" style="text-align:center">
															<div class="btn-group">
																<a class="btn btn-primary btn-element btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'edit']) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
																<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'view']) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
															</div>
														</td>
													</tr>
												<?php }else{ ?>
													<tr>
														<td><?= $acos[$i][$j]['action'] ?></td>
														<td class="actions" style="text-align:center">
															<div class="btn-group">
																<a class="btn btn-primary btn-element btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'edit']) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
																<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'view']) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
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
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<div class="modal fade" id="modal-default">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Default Modal</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary"><?= __('Activer') ?></button>
			</div>
		</div>
	  </div>
	</div>