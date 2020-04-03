<?= $this->Html->css('custom.css') ?>
<section class="content-header">
	<h1><?= __('GESTION DES MICRODONNÉES') ?>
		<small>
			<?php 
				if($ui == null){
					echo __('Consultation');
				}
				else{
					if($ui->group->group_abrev == 'MA') echo __('Management');
					if($ui->group->group_abrev == 'AS') echo __('Édition');
					if($ui->group->group_abrev == 'AV') echo __('Validation');
					if($ui->group->group_abrev == 'AP') echo __('Publication');
				}
			?>
		</small>
	</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?= __('Filtrer les données') ?></h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formSearch', 'class'=>'', 'url'=>['controller' => 'Mdvs', 'action' => 'index'])); ?>
					<?php echo $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'listesliees']), 'hidden' => true]); ?>
					<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
					<?php if($stType == 'CE' || $stType == null){ ?>
					<div class="col-xs-2">
						<label><?= __('Région') ?></label>
						<?php echo $this->Form->control('region_id', ['label'=>false, 'id'=>'region', 'onChange'=>'selectDepartment();startSearch()', 'class'=>'form-control input-sm', 'options' => $regions, 'default' => $default[0], 'empty'=>' -- Sélectionner la région -- ']);	?>
					</div>
					<?php }else echo $this->Form->hidden('region_id', ['label'=>false, 'id'=>'region', 'hidden'=>true, 'default' => $default[0]]); ?>
					<?php if($stType != 'DE' && $stType != 'CO'){ ?>
					<div class="col-xs-2">
						<label><?= __('Département') ?></label>
						<?php  echo $this->Form->control('department_id', ['label'=>false, 'id'=>'department', 'onChange'=>'selectTown();startSearch()', 'class'=>'form-control input-sm', 'options' => $departments, 'default' => $default[1], 'empty'=>' -- Sélectionner le département -- ']);	?>
					</div>
					<?php }else echo $this->Form->hidden('department_id', ['label'=>false, 'id'=>'department', 'hidden'=>true, 'default' => $default[1]]); ?>
					<?php if($stType != 'CO'){ ?>
					<div class="col-xs-2">
						<label><?= __('Commune') ?></label>
						<?php echo $this->Form->control('town_id', ['label'=>false, 'id'=>'town', 'onChange'=>'startSearch()', 'class'=>'form-control input-sm', 'options' => $towns, 'default' => $default[2], 'empty'=>' -- Sélectionner la commune -- ']);	?>
					</div>
					<?php }else echo $this->Form->hidden('town_id', ['label'=>false, 'id'=>'town', 'hidden'=>true, 'default' => $default[2]]); ?>
					<div class="col-xs-2">
						<label><?= __('Thème') ?></label>
						<?= $this->Form->control('theme_id', ['label'=>false, 'class'=>'form-control input-sm', 'id'=>'theme', 'onChange'=>'selectDomain2();startSearch()', 'options' => $themes, 'default' => $default[3], 'empty'=>' -- Sélectionner le statut -- ']); ?>
					</div>
					<div class="col-xs-2">
						<label><?= __('Domaine') ?></label>
						<?= $this->Form->control('domain_id', ['label'=>false, 'class'=>'form-control input-sm', 'id'=>'domain', 'onChange'=>'startSearch()', 'options' => $domains, 'default' => $default[4], 'empty'=>' -- Sélectionner le statut -- ']); ?>
					</div>
					<div class="col-xs-2" style="">
						<label><?= __('Année') ?></label>
						<?= $this->Form->control('version_year', ['label'=>false, 'class'=>'form-control input-sm', 'id'=>'year', 'onChange'=>'startSearch()', 'options' => $versions, 'default' => $default[5]]); ?>
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title pull-right" style="color:red"><i><?= __('Micro données ').$microdata[0][0]['struct'] ?></i></h3>
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
								<table id="example2" class="table table-sm table-bordered table-hover dataTable" role="grid" aria-describedby="">
									<thead>
										<tr role="row" style="background-color:#ECF0F5">
											<th scope="col" style="width:40%;" class=""><?= __('MICRODONNEES') ?></th>
											<th scope="col" style="width:12%;"><?= __('VALEUR') ?></th>
											<th scope="col" style=""><?= __('SOURCE') ?></th>
											<th scope="col" style="width:8%;text-align:center"><?= __('UNITE') ?></th>
											<th scope="col" style="width:14%;text-align:center"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $count = 1; ?>
										<?php for($i=1;$i<=(sizeof($microdata)-1);$i++){ ?>
											<?php if($microdata[$i][0]['action'] == 'CREATE'){ ?>
												<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formEditMd'.$count)); ?>
												<tr role="row" class="">
													<td style="vertical-align:middle;font-weight:bold;">
														<?php
															echo h($microdata[$i][0]['mdName']);
															echo $this->Form->hidden('mdc_id', ['id'=>'idMd'.$count, 'value' =>$microdata[$i][0]['mdId']]);
															echo $this->Form->hidden('mdv_id', ['id'=>'idMdv'.$count, 'value' =>null]);
														?>
													</td>
													<td style="vertical-align:middle;"><div class="hide" id="<?php echo 'colVal'.$count;  ?>"><?php echo $this->Form->control('mdvs_value',['label'=>false, 'required'=>true, 'type'=>'text', 'data-inputmask' => "'mask': ['999999999']", 'data-mask' => '', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%;height:28px']); ?></div></td>
													<td style="vertical-align:middle;"><div class="hide" id="<?php echo 'colSrc'.$count;  ?>"><?php echo $this->Form->control('mdvs_source', ['label' => false, 'required' => true, 'id'=>'srcMd'.$count, 'class' => 'form-control select2', 'style'=>'width:100%;', 'options' => $structures, 'empty' => '-- Sélectionner une source --']); ?></div></td>
													<td style="vertical-align:middle;text-align:center"><div class="hide" id="<?php echo 'colUni'.$count;  ?>"><?php echo $this->Form->control('mdvs_unite',['label'=>false, 'disabled'=>true, 'options' => $units, 'default' => $microdata[$i][0]['mdUnit'], 'id'=>'uniMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%;height:28px']); ?></div></td>
													<td style="text-align:center">
														<?php if($microdata[0][0]['btnSaisir'] == 1){ ?>
														<button class="btn btn-primary btn-element btn-xs" type="button" onclick="editMd(<?php echo $count; ?>)" id="<?php echo 'btnEditMd'.$count; ?>"><i class="fa fa-pencil"></i><?php echo __(' Saisir'); ?></button>
														<button class="btn btn-primary btn-element btn-xs hide" type="button" onclick="saveMd(<?php echo $count; ?>)" id="<?php echo 'btnSave'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
														<button class="btn btn-primary btn-danger btn-xs hide" type="button" onclick="cancelMd(<?php echo $count; ?>)" id="<?php echo 'btnCancel'.$count; ?>"><i class="fa fa-times"></i><?php echo __(' Annuler'); ?></button>
														<button class="btn btn-primary btn-element btn-xs hide" type="button" onclick="modMd(<?php echo $count; ?>)" id="<?php echo 'btnMod'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
														<?php } else { ?>
															<button class="btn btn-default btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Créée'); ?></button>
														<?php } ?>
													</td>
												</tr>
												<?php echo $this->Form->end(); ?>
											<?php } ?>	
											<?php if($microdata[$i][0]['action'] == 'EDIT'){$rowspan = $microdata[$i][0]['newRecord']>0 ? (sizeof($microdata[$i])+1) : (sizeof($microdata[$i])); ?>
												<?php for($j=0;$j<=(sizeof($microdata[$i])-1);$j++){ ?>
													<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formEditMd'.$count)); ?>
													<?php if($j==0){ ?>
														<tr style="">
															<td rowspan=<?php echo $rowspan; ?> style="vertical-align:middle;font-weight:bold;">
																<?php
																	echo h($microdata[$i][0]['mdName']);
																	echo $this->Form->hidden('mdc_id', ['id'=>'idMd'.$count, 'value' =>$microdata[$i][0]['mdId']]);
																	echo $this->Form->hidden('mdv_id', ['id'=>'idMdv'.$count, 'value' =>$microdata[$i][0]['idMdv']]);
																?>
															</td>
															<td style="vertical-align:middle;font-style:italic;">
																<div class="" id="<?php echo 'colVal'.$count;  ?>">
																	<?php 
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_value',['label'=>false, 'value' =>$microdata[$i][$j]['value'], 'required'=>true, 'type'=>'text', 'data-inputmask' => "'mask': ['999999999']", 'data-mask' => '', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%']);
																		else echo $microdata[$i][$j]['value'];
																	?>
																</div>
															</td>
															<td style="vertical-align:middle;font-style:italic;">
																<div class="" id="<?php echo 'colSrc'.$count;  ?>">
																	<?php
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_source',['label'=>false, 'required'=>true, 'id'=>'srcMd'.$count, 'class'=>'form-control select2', 'options' => $structures, 'default' => $microdata[$i][$j]['source'], 'style'=>'width:100%;height:30px', 'empty' => '-- Sélectionner une source --']);
																		else echo $microdata[$i][$j]['sourceName'];
																	?>
																</div>
															</td>
															<td style="vertical-align:middle;text-align:center">
																<div class="" id="<?php echo 'colUni'.$count;  ?>">
																	<?php
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_unite',['label'=>false, 'value' =>$microdata[$i][$j]['unite'], 'disabled'=>true, 'options' => $units, 'default' => $microdata[$i][0]['mdUnit'], 'id'=>'uniMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%']);
																		else echo $microdata[$i][$j]['unitName'];
																	?>
																</div>
															</td>															
															<td style="text-align:center">																
																<?php if($microdata[$i][$j]['state'] == 0){ ?>
																	<?php if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group']){ ?>
																		<button class="btn btn-primary btn-element btn-xs" type="button" onclick="modMd(<?= $count ?>)" id="<?php echo 'btnMod'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
																	<?php } elseif($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == 'AV'){ ?>
																		<button type="button" class="btn btn-danger btn-xs" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'val'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popValidate">
																			<i class="fa fa-times" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Valider'); ?>
																		</button>
																		<button type="button" class="btn btn-success btn-xs hide" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'inv'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popInvalidate">
																			<i class="fa fa-check" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Invalider'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-default btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Editée').' / '.$microdata[$i][$j]['stType']; ?></button>
																	<?php } ?>
																<?php } ?>
																<?php if($microdata[$i][$j]['state'] == 1){ ?>
																	<?php if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == 'AV'){ ?>
																		<button type="button" class="btn btn-danger btn-xs hide" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'val'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popValidate">
																			<i class="fa fa-times" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Valider'); ?>
																		</button>
																		<button type="button" class="btn btn-success btn-xs" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'inv'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popInvalidate">
																			<i class="fa fa-check" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Invalider'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-warning btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Validée').' / '.$microdata[$i][$j]['stType']; ?></button>
																	<?php } ?>
																<?php } ?>
																<?php if($microdata[$i][$j]['state'] == 2){ ?>
																	<?php if($ui->id == $microdata[$i][$j]['userPub'] && $stType == 'CE'){ ?>
																		<button type="button" class="btn btn-success btn-xs" onclick="modMdPub(<?php echo $count; ?>)" id="<?php echo 'btnMod'.$count; ?>" data-toggle="modal" data-target="#popEditPub">
																			<i class="fa fa-check"></i><?php echo __(' Modifier'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-success btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Publiée'); ?></button>
																	<?php } ?>
																<?php } ?>																
															</td>
														</tr>
													<?php }else{ $count++; ?>
														<tr>															
															<?php
																echo $this->Form->hidden('mdc_id', ['id'=>'idMd'.$count, 'value' =>$microdata[$i][0]['mdId']]);
																echo $this->Form->hidden('mdv_id', ['id'=>'idMdv'.$count, 'value' =>$microdata[$i][$j]['idMdv']]);
															?>
															<td style="vertical-align:middle;font-style:italic;">
																<div class="" id="<?php echo 'colVal'.$count;  ?>">
																	<?php 
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_value',['label'=>false, 'value' =>$microdata[$i][$j]['value'], 'required'=>true, 'type'=>'text', 'data-inputmask' => "'mask': ['999999999']", 'data-mask' => '', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%']);
																		else echo $microdata[$i][$j]['value'];
																	?>
																</div>
															</td>
															<td style="vertical-align:middle;font-style:italic;">
																<div class="" id="<?php echo 'colSrc'.$count;  ?>">
																	<?php
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_source',['label'=>false, 'required'=>true, 'id'=>'srcMd'.$count, 'class'=>'form-control select2', 'options' => $structures, 'default' => $microdata[$i][$j]['source'], 'style'=>'width:100%;height:30px', 'empty' => '-- Sélectionner une source --']);
																		else echo $microdata[$i][$j]['sourceName'];
																	?>
																</div>
															</td>
															<td style="vertical-align:middle;text-align:center">
																<div class="" id="<?php echo 'colUni'.$count;  ?>">
																	<?php
																		if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group'])
																			echo $this->Form->control('mdvs_unite',['label'=>false, 'value' =>$microdata[$i][$j]['unite'], 'disabled'=>true, 'options' => $units, 'default' => $microdata[$i][0]['mdUnit'], 'id'=>'uniMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%']);
																		else echo $microdata[$i][$j]['unitName'];
																	?>
																</div>
															</td>	
															<td style="text-align:center">
																<?php if($microdata[$i][$j]['state'] == 0){ ?>
																	<?php if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == $microdata[$i][$j]['group']){ ?>
																		<button class="btn btn-primary btn-element btn-xs" type="button" onclick="modMd(<?= $count ?>)" id="<?php echo 'btnMod'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
																	<?php } elseif($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == 'AV'){ ?>
																		<button type="button" class="btn btn-danger btn-xs" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'val'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popValidate">
																			<i class="fa fa-times" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Valider'); ?>
																		</button>
																		<button type="button" class="btn btn-success btn-xs hide" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'inv'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popInvalidate">
																			<i class="fa fa-check" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Invalider'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-default btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Editée').' / '.$microdata[$i][$j]['stType']; ?></button>
																	<?php } ?>
																<?php } ?>
																<?php if($microdata[$i][$j]['state'] == 1){ ?>
																	<?php if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == 'AV'){ ?>
																		<button type="button" class="btn btn-danger btn-xs hide" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'val'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popValidate">
																			<i class="fa fa-times" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Valider'); ?>
																		</button>
																		<button type="button" class="btn btn-success btn-xs" onclick="valOrNot(<?= $microdata[$i][$j]['idMdv'] ?>)" id="<?php echo 'inv'.$microdata[$i][$j]['idMdv']; ?>" data-toggle="modal" data-target="#popInvalidate">
																			<i class="fa fa-check" id="<?php echo 'faVal'.$microdata[$i][$j]['idMdv']; ?>"></i><?php echo __(' Invalider'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-warning btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Validée').' / '.$microdata[$i][$j]['stType']; ?></button>
																	<?php } ?>
																<?php } ?>
																<?php if($microdata[$i][$j]['state'] == 2){ ?>
																	<?php if($ui->id == $microdata[$i][$j]['userPub'] && $stType == 'CE'){//if($stType == $microdata[$i][$j]['stType'] && $ui->group->group_abrev == 'MA'){ ?>
																		<button type="button" class="btn btn-success btn-xs" onclick="modMdPub(<?php echo $count; ?>)" id="<?php echo 'btnMod'.$count; ?>" data-toggle="modal" data-target="#popEditPub">
																			<i class="fa fa-check"></i><?php echo __(' Modifier'); ?>
																		</button>
																	<?php } else { ?>
																		<button class="btn btn-success btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Publiée'); ?></button>
																	<?php } ?>
																<?php } ?>	
															</td>
														</tr>
													<?php } ?>
													<?php echo $this->Form->end(); ?>
												<?php } ?>
												<?php if($microdata[$i][0]['newRecord'] > 0){$count++; ?>
													<tr>
														<?php
															echo $this->Form->hidden('mdc_id', ['id'=>'idMd'.$count, 'value' =>$microdata[$i][0]['mdId']]);
															echo $this->Form->hidden('mdv_id', ['id'=>'idMdv'.$count, 'value' =>$microdata[$i][0]['idMdv']]);
														?>
														<td style="vertical-align:middle;"><div class="" id="<?php echo 'colVal'.$count;  ?>"><?php echo $this->Form->control('mdvs_value',['label'=>false, 'required'=>true, 'type'=>'text', 'data-inputmask' => "'mask': ['999999999']", 'data-mask' => '', 'placeholder' => 'Saisir la valeur', 'id'=>'valMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%;height:28px']); ?></div></td>
														<td style="vertical-align:middle;"><div class="" id="<?php echo 'colSrc'.$count;  ?>"><?php echo $this->Form->control('mdvs_source', ['label' => false, 'required' => true, 'id'=>'srcMd'.$count, 'class' => 'form-control select2', 'style'=>'width:100%;', 'options' => $structures, 'empty' => '-- Sélectionner une source --']); ?></div></td>
														<td style="vertical-align:middle;text-align:center"><div class="" id="<?php echo 'colUni'.$count;  ?>"><?php echo $this->Form->control('mdvs_unite',['label'=>false, 'disabled'=>true, 'options' => $units, 'default' => $microdata[$i][0]['mdUnit'], 'id'=>'uniMd'.$count, 'class'=>'form-control input-sm', 'style'=>'width:100%;height:28px']); ?></div></td>
														<td style="text-align:center">
																<button class="btn btn-primary btn-element btn-xs" type="button" onclick="saveMd(<?php echo $count; ?>)" id="<?php echo 'btnSave'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
															<div class="btn-group">
																<button class="btn btn-primary btn-element btn-xs hide" type="button" onclick="modMd(<?php echo $count; ?>)" id="<?php echo 'btnMod'.$count; ?>"><i class="fa fa-save"></i><?php echo __(' Enreg'); ?></button>
															</div>
														</td>
													</tr>
												<?php } ?>
											<?php } ?>
											<?php if($microdata[$i][0]['action'] == 'VIEW'){ ?>
												<tr role="row" class="">
													<td style="vertical-align:middle;font-weight:bold;"><?php echo h($microdata[$i][0]['mdName']); ?></td>
													<td style="vertical-align:middle;"><?php echo $microdata[$i][0]['value']; ?></td>
													<td style="vertical-align:middle;"><?php echo $microdata[$i][0]['sourceName']; ?></td>
													<td style="vertical-align:middle;text-align:center"><?php echo $microdata[$i][0]['unitName']; ?></td>
													<td style="text-align:center">
														<?php if($microdata[$i][0]['state'] == 2){ ?>
														<button class="btn btn-success btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Publiée'); ?></button>
														<?php } else { ?>
														<button class="btn btn-default btn-xs disabled" type="button"><i class="fa fa-check"></i><?php echo __(' Créée'); ?></button>
														<?php } ?>
													</td>
												</tr>
											<?php } ?>	
											<?php $count++; ?>	
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-xs-12" style="text-align:center"><?php if(sizeof($microdata) <= 1) echo __('Aucune micro-donnée correspondante.'); ?></div>
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
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<style>
	.col-xs-12{
		padding-left:0px;
		padding-right:0px;
	}
	.box{
		margin-bottom:0px;
	}
	.box-header.with-border {
		border-bottom: 1px solid 
		#ccc;
	}
</style>
<script language="javascript">
	num = no = noId = noLi = 0;
	$(document).ready(function() {
		$('.select2').select2();
		$('[data-mask]').inputmask()
	});	
	jQuery(function($) {		
		$("#flash_render_success").show(function() {
			$.gritter.add({
				title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert-success'
			});
			return false;
		});
		$("#flash_render_error").show(function() {
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Echec d\'enregistrement</i>',
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
			return false;
		});	
	});
	
	
	function saveMd(no) {		
		saveMd_Next(no,"<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edition']); ?>");
	}
	function modMd(no) {
		modMd_Next(no,"<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edit']); ?>");//+"/"+$('#idMd'+no).val()
	}
	function modMdPub(no) {
		num = $('#idMdv'+no).val();
		noLi = no;
	}
	function actionEditPub() {
		modMd_Next(noLi,"<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edit']); ?>");
	}
	function valOrNot(idMdv) {
		num = idMdv;
	}
	function pubOrNot(idMdv) {//alert(idMdv);
		num = idMdv;
	}
	function actionValOrNot() {//alert(num);
		$.ajax({
			url: "<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'validation']); ?>" + "/" + num,
			type: "GET",
			success: function(data) {
				//alert(data);
				if(data == 1){
					$("#val"+num).addClass('hide');
					$("#inv"+num).removeClass('hide');
					alert("Micro donnée validée avec succès");
				}else{
					$("#inv"+num).addClass('hide');
					$("#val"+num).removeClass('hide');
					alert("Micro donnée invalidée avec succès");
				}
			}
		});
	}
	
	function actionPubOrNot() {
		//alert(num);
		$.ajax({
			url: "<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'publication']); ?>" + "/" + num,
			type: "GET",
			success: function(data) {
				//alert(data);
				if(data == 1){
					$("#pub"+num).removeClass('btn-danger');
					$("#faPub"+num).removeClass('fa-times');
					$("#faPub"+num).addClass('fa-check');
					$("#pub"+num).addClass('btn-success');
				}else{
					$("#depub"+num).removeClass('btn-success');
					$("#faDepub"+num).removeClass('fa-check');
					$("#faDepub"+num).addClass('fa-times');
					$("#depub"+num).addClass('btn-danger');
				}
				$("#popPub").removeClass('modal');
				$("#popDepub").removeClass('modal');
			}
		});
	}
</script>
