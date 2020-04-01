<div class="login-box" style="width:400px;">
	<div class="" style="text-align:center">
		<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" style="font-size:15px;text-align:center"><b><?= __('PLATE-FORME WEBMAPPING POUR LA GESTION DES INDICATEURS URBAINS AU CAMEROUN') ?></b></a>
		
	</div>
	<div class="login-box-body" style="box-shadow: 0 0 8px rgba(0,0,0,0.5);">
		<?php 	echo $this->Html->image('ins.png',['style'=>'width:30px;height:30px','class'=>'']);	?>
		<?php 	echo $this->Html->image('minhdu.png',['style'=>'width:40px;height:40px','class'=>'pull-right']);	?>
		<p class="login-box-msg"><?= __('CONNEXION A LA PLATEFORME') ?></p>
		<?= $this->Form->create() ?>
			<div class="form-group has-feedback">
				<?= $this->Form->input('username', ['label' => false, 'required' => true, 'class' => 'form-control', 'text' => 'text', 'placeholder' => 'Identifiant de connexion']) ?>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password', ['label' => false, 'required' => true, 'class' => 'form-control', 'text' => 'password', 'placeholder' => 'Mot de passe']) ?>
				<span class="fa fa-key form-control-feedback"></span>
			</div>
			<div style="text-align:center hide"><?= $this->Flash->render() ?></div><br>
			<div class="form-group has-feedback" style="margin-right:23px">
				<div class="col-xs-8"></div>
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary"><?= __(' Se connecter') ?></button>
				</div>
			</div>
			<!-- /.col -->
		<?= $this->Form->end() ?><br><br>
		<a href="#"><?= __(' Mot de passe oublié?') ?></a>
		<a class="pull-right" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'inscription']) ?>"><?= __(' Pas encore inscrit?') ?></a><br><br>
		<a  href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>"><i class="fa fa-home"></i><?= __(' Page d\'accueil') ?></a><br>
	</div>
</div>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<script language="javascript">	
	jQuery(function($) {
		$("#flash_render_info").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'alert alert-info'
			});
			return false;
		});
	});
</script>