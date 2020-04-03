<section class="content-header">
	<h4><?= __('INDICATEURS URBAINS') ?><small><?= __('Visualisation des données') ?></small></h4>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="col-md-5 box-footer">
						<div class="box box-solid">
							<div class="box-header with-border">
								<i class="fa fa-line-chart"></i>
								<h3 class="box-title"><b><?= __(' NOTION D\'INDICATEUR URBAIN') ?></b></h3>
							</div>
							<div class="box-body">
								<dl class="dl-horizontal">
									<dt style="width:130px;padding-right:10px;"><?= __(' <i>Définition</i> ') ?></dt>
									<dd style="margin-left:130px;text-align:justify"><?= __('Un <b>indicateur</b> est un outil d\'évaluation et d\'aide à la décision. Cette plate-forme fourni des informations au niveau des villes et des communes sur des indicateurs liés aux conditions de vie des populations.') ?></dd>
									<dt style="width:130px;padding-right:10px;"><?= __(' <i>Principe de calcul</i>') ?></dt>
									<dd style="margin-left:130px;text-align:justify"><?= __('Un indicateur est une formule qui prend pour paramètres les valeurs des <b>micro-données</b> saisies au niveau des villes et des communes.') ?></dd>
								</dl>
							</div>
						</div>
					</div>
					<div class="col-xs-7 box-footer">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="info-box bg-green">
								<span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text"><?= __('indicateurs urbains') ?></span>
								  <span class="info-box-number">41,410</span>
								  <div class="progress">
									<div class="progress-bar" style="width: 70%"></div>
								  </div>
									  <span class="progress-description">
										70% Increase in 30 Days
									  </span>
								</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="info-box bg-aqua">
								<span class="info-box-icon"><i class="fa fa-object-group"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text"><?= __('microdonnées') ?></span>
								  <span class="info-box-number">41,410</span>
								  <div class="progress">
									<div class="progress-bar" style="width: 70%"></div>
								  </div>
									  <span class="progress-description">
										70% Increase in 30 Days
									  </span>
								</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs pull-right">
										<li class="pull-left header" style="margin:2px 0px;font-weight:bold"><i class="fa fa-th"></i><?= __(' INDICATEURS URBAINS') ?></li>
									</ul>
									<div class="box-body">
										<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
										<?php echo $this->Form->hidden('urlIu', ['label' => false,'id'=>'urlIu', 'value'=>$this->Url->build(['controller' => 'Indicators', 'action' => 'listesliees']), 'hidden' => true]); ?>
										<div class="input-group col-xs-5 pull-right">
											<div class="input-group-btn">
												<button type="button" class="btn btn-primary"><?= __('Domaine') ?></button>
											</div>
											<?= $this->Form->control('domain_id', ['label' => false, 'id'=>'domain', 'onchange'=>'selectIuDomain();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm select2', 'options' => $domains, 'empty' => '-- Sélectionner un domaine --']) ?>
										</div>
										<div class="input-group col-xs-6 pull-left">
											<div class="input-group-btn">
												<button type="button" class="btn btn-primary"><?= __('Thème') ?></button>
											</div>
											<?= $this->Form->control('theme_id', ['label' => false, 'id'=>'theme', 'onchange'=>'selectDomain2();selectIuTheme();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm select2', 'options' => $themes, 'empty' => '-- Sélectionner un thème --']) ?>
										</div>
									</div>
									<div class="tab-content box-footer">
										<div class="row">
											<div style="">
												<ul class="control-sidebar-menu" id="indicateurs">
												<?php foreach ($indicators as $indicator): ?>
												<li id="li-style">
													<a href="<?php echo $this->Url->build(['controller' => 'Indicators', 'action' => 'view', $indicator->id]); ?>">
														<i class="menu-icon fa fa-globe bg-green"></i>
														<div class="menu-info">
															<h4 class="control-sidebar-subheading"><?= h($indicator->indicator_name_fr) ?></h4>
															<p><i><?= h($indicator->indicator_desc_fr) ?></i></p>
														</div>
													</a>
												</li>
												<?php endforeach; ?>
											</ul>
											</div><br>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
	a, a:hover, a:active, a:focus {
		color: #000;
	}
	#li-style {
		padding:4px;
	}
</style>