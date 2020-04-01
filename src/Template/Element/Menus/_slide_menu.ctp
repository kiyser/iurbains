<aside class="control-sidebar control-sidebar-light control-sidebar-open">   
	<div class="row" style="padding:12px 10px;margin:0px">
		<i class="fa fa-search"></i><?= __(' FILTREZ LES DONNEES') ?>
		<a class="btn btn-success btn-xs pull-right" href="#" data-toggle="control-sidebar" style=""><i class="fa fa-times"></i><?= __(' Fermer') ?></a>
	</div>    
    <div class="tab-content">
		<div class="box box-primary box-solid">
			<div class="box-header with-border" style="font-size:11px;font-weight:bold">
				<?= __('COUCHES ADMINISTRATIVES') ?>
				<div class="box-tools"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
			</div>
			<div class="box-body">
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('region_id', ['label' => false, 'id'=>'region', 'onchange'=>'selectDepartment();selectRegionLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $regionsList, 'empty' => '--Région--']) ?></i>
				</div>
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('department_id', ['label' => false, 'id'=>'department', 'onchange'=>'selectTown();selectDepartmentLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $departmentsList, 'empty' => '--Département--']) ?></i>
				</div>
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('town_id', ['label' => false, 'id'=>'town', 'onchange'=>'selectTownLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $townsList, 'empty' => '--Commune--']) ?></i>
				</div>
			</div>
		</div>
		<div class="box box-primary box-solid">
			<div class="box-header with-border" style="font-size:11px;font-weight:bold">
				<?= __('DOMAINES, THEMES ET VERSIONS') ?>
				<div class="box-tools"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
			</div>
			<div class="box-body">
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('theme_id', ['label' => false, 'id'=>'theme', 'onchange'=>'selectDomain2();selectIuTheme();selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $themes, 'empty' => '--Thème--']) ?></i>
				</div>
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('domain_id', ['label' => false, 'id'=>'domain', 'onchange'=>'selectIuDomain();selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $domains, 'empty' => '--Domaine--']) ?></i>
				</div>
				<div class="col-xs-4" style="padding:1px">
					<i><?= $this->Form->control('version_id', ['label' => false, 'id'=>'version', 'onchange'=>'selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $versionList, 'default' => '1']) ?></i>
				</div>
			</div>
		</div>
		<div class="box box-primary box-solid collapsed-box">
			<div class="box-header with-border" style="font-size:11px;font-weight:bold">
				<?= __('INDICATEURS URBAINS') ?>
				<div class="box-tools"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button></div>
			</div>
			<div class="box-body">
				<div class="scroller">
					<table id="indicateurs" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
						<tbody>
							<?php foreach ($indicators as $indicator): ?>
							<tr>
								<td style="width=2%"><input type="checkbox"></td>
								<td>
									<ul class="control-sidebar-menu">
										<li>
											<a href="#">
												<div class="menu-info">
													<h6 class="control-sidebar-subheading"><?= h($indicator->indicator_name_fr) ?></h6>
												</div>
											</a>
										</li>
									</ul>
								</td>
							</tr>
							<?php endforeach; ?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="box box-primary box-solid">
			<div class="box-header with-border" style="font-size:11px;font-weight:bold">
				<?= __('MICRODONNEES') ?>
				<div class="box-tools"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
			</div>
			<div class="box-body">
				<div class="scroller">
					<table id="microdonnees" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
						<tbody>					
							<?php foreach ($microdata as $data): ?>
							<tr onClick="setMicrodata(<?php echo $data->id; ?>)">
								<td style="width=2%"><input type="checkbox"></td>
								<td>
									<ul class="control-sidebar-menu">
										<li>
											<a href="#">
												<div class="menu-info">
													<h6 class="control-sidebar-subheading"><?= $data->mdcs_name_fr ?></h6>
												</div>
											</a>
										</li>
									</ul>
								</td>
							</tr>
							<?php endforeach; ?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
</aside>

<style>
	.box{
		margin-bottom:1px;
	}
	.form-group{
		font-size:12px;
		margin-bottom:0px;
	}
	.box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title{
		font-size:15px;
	}
	.control-sidebar-bg, .control-sidebar{
		width:300px;
	}
	.nav-tabs.nav-justified > li > a{
		text-align:left;
	}
	.control-sidebar-menu > li > a {
		padding: 1px 15px;
	}
	.control-sidebar > .tab-content {
		padding: 0px;
	}
	.control-sidebar-open .content-wrapper {
		margin-right:300px;
	}
	.right-side, .control-sidebar-open .main-footer {
		margin-right:0px;
	}
	.skin-blue .wrapper, .skin-blue , .skin-blue .left-side {
		background-color:#ECF0F5
	}
	
	
	.scroller {
		max-height: 250px;
		position: relative;
		overflow: auto;
		scrollbar-width: thin;
		scrollbar-color: #3C8DBC #ECF0F5;
	}
</style>

<script>
$(function() {
  $(window).on("load", function() {
    $("#scroll3").mCustomScrollbar({
      scrollButtons: {
        enable: true
      },
      theme: "dark-thin",
      scrollbarPosition: "outside",
      autoHideScrollbar: false,
      alwaysShowScrollbar: 2
    });
  });
});
</script>