<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('GESTION DES UTILISATEURS') ?><small><?= __('Liste des utilisateurs') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a class="btn btn-primary btn-element btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>"><i class="fa fa-user-plus"></i><?= __(' Créer un compte') ?></a>
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
											<th scope="col">#</th>
											<th scope="col"><?= __('NOM(S)') ?></th>
											<th scope="col" style="width:auto"><?= __('GROUPE UTILISATEUR') ?></th>
											<th scope="col" class="actions" style="width:21%"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user): ?>
										<tr>
											<td><span class="badge bg-blue"><?= $this->Number->format($user->id) ?></span></td>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= h($user->lastname).' '.h($user->firstname) ?></h4>
																<p><i><?= '<i class="fa fa-mobile"></i> '.$user->portable.', <i class="fa fa-at"></i> '.$user->email ?></i></p>
															</div>
														</a>
													</li>
												</ul>
											</td>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= $user->has('group') ? $user->group->group_name_fr : ''?></h4>
																<p><i><?= $user->has('structure') ? $user->structure->structure_name_fr.', ' : '' ?><?= '<i class="fa fa-calendar"></i> '.$user->created ?></i></p>
															</div>
														</a>
													</li>
												</ul>
											</td>
											<td class="actions">
												<div class="">
													<a class="btn btn-default btn-sm" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $user->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
													<?php if($user->statut == 0 && $user->activate_by == null && $user->activate_date == null){ ?>
														<a class="btn btn-primary btn-danger btn-sm" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $user->id]) ?>"><i class="fa fa-times"></i><?= __(' Activer') ?></a>
													<?php }else{ ?>
														<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $user->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
														<?php if($user->statut == 10) { ?>
															<button type="button" class="btn btn-danger btn-sm" onclick="actDesact(<?= $user->id ?>)" id="<?php echo 'act'.$user->id; ?>" data-toggle="modal" data-target="#popActivate">
																<i class="fa fa-times" id="<?php echo 'faAct'.$user->id; ?>"></i>
															</button>
														<?php }else{ ?>
															<button type="button" class="btn btn-success btn-sm" onclick="actDesact(<?= $user->id ?>)" id="<?php echo 'desact'.$user->id; ?>" data-toggle="modal" data-target="#popDesactivate">
																<i class="fa fa-check" id="<?php echo 'faDesact'.$user->id; ?>"></i>
															</button>													
														<?php } ?>
													<?php } ?>
												</div>												
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
									<?= $this->Paginator->counter(['format' => __('Page {{page}}/{{pages}}, {{current}} enregistrement(s) sur {{count}} au total.')]) ?>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
									<ul class="pagination" style="margin:0px;float:right;">
										<?= $this->Paginator->first(__('Début')) ?>
										<?= $this->Paginator->prev(__('Préc.')) ?>
										<?= $this->Paginator->numbers() ?>
										<?= $this->Paginator->next(__('Suiv.')) ?>
										<?= $this->Paginator->last(__('Fin')) ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>
<?= $this->element('popUpAlert') ?>
<style>
	.box{
		margin-bottom:2px;
	}
	
	.control-sidebar-bg, .control-sidebar{
		width:700px;
	}
	.nav-tabs.nav-justified > li > a{
		text-align:left;
	}
	.control-sidebar-dark, .control-sidebar-dark + .control-sidebar-bg {
		background: #3C8DBC;
	}
	.control-sidebar-menu > li > a {
		padding: 5px 15px;
	}
	.control-sidebar-menu .menu-icon {
		width: 30px;
		height: 30px;
		line-height: 30px;
	}
	.control-sidebar-heading {
		padding: 0px;
	}
	a, a:hover, a:active, a:focus {
		color: #000;
	}
	.control-sidebar-subheading {
		font-size: 14px;
	}
	
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 3px;
		vertical-align: middle;
	}
	.control-sidebar-menu .menu-info {
		margin-left: 0px;
		margin-top: 3px;
	}
</style>

<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery.gritter.min') ?>
<?= $this->Html->script('custom/utils') ?>
<script language="javascript">
	jQuery(function($) {
		$("#flash_render_success").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-success'
			});
			return false;
		});
		$("#flash_render_error").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert-error'
			});
			return false;
		});
	});
	num = state = 0;
	function actDesact(idUser) {
		num = idUser;
	}
	function actionActOrDesact() {
		//alert(num);
		$.ajax({
			url: "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'edit']); ?>" + "/" + num,
			type: "GET",
			success: function(data) {
				alert(data);
				if(data == 1){
					$("#act"+num).removeClass('btn-danger');
					$("#faAct"+num).removeClass('fa-times');
					$("#faAct"+num).addClass('fa-check');
					$("#act"+num).addClass('btn-success');
				}else{
					$("#desact"+num).removeClass('btn-success');
					$("#faDesact"+num).removeClass('fa-check');
					$("#faDesact"+num).addClass('fa-times');
					$("#desact"+num).addClass('btn-danger');
				}
			}
		});
	}
</script>