<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('GROUPES UTILISATEURS') ?><small><?= __('Détails d\'un groupe') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= __('Informations du groupe') ?></h3>
				</div>
				<div class="box-body no-padding">
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td style="width:20%"><?= __('Identifiant du groupe :') ?></td>
								<td style="width:30%;font-weight:bold"><?= $this->Number->format($group->id) ?></td>
								<td style="width:20%"><?= __('Date de création :') ?></td>
								<td style="width:30%;font-weight:bold"><?= h($group->created) ?></td>
							</tr>
							<tr>
								<td style="width:20%"><?= __('Nom du groupe :') ?></td>
								<td style="width:30%;font-weight:bold"><?= h($group->group_name_fr) ?></td>
								<td style="width:20%"><?= __('Dernière modification :') ?></td>
								<td style="width:30%;font-weight:bold"><?= h($group->modified) ?></td>
							</tr>
							<tr>
								<td style="width:20%"><?= __('Code :') ?></td>
								<td style="width:30%;font-weight:bold"><?= h($group->group_abrev) ?></td>
								<td style="width:20%"></td>
								<td style="width:30%;font-weight:bold"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= __('Liste des utilisateurs du groupe') ?></h3>
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
											<th scope="col">#</th>
											<th scope="col"><?= __('Utilisateur') ?></th>
											<th scope="col" style="width:15%;text-align:center"><?= __('Date d\'inscription') ?></th>
											<th scope="col" class="actions" style="width:18%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php  foreach ($group->users as $users): ?>
										<tr>
											<td><?= $this->Number->format($users->id) ?></td>
											<td><?= h($users->lastname).' '.h($users->lastname) ?></td>
											<td style="text-align:center"><?= h($users->created) ?></td>
											<td class="actions" style="text-align:center">
												<div class="btn-group">
													<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $users->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
													<a class="btn btn-default btn-sm" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $users->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
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
							</div>
							<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
									<?php if($group->users == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>';?>
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
<!-- /.content -->