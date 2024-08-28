<div class="adminusers form">
<?php echo $this->Form->create('Adminuser'); ?>
	<fieldset>
		<legend><?php echo __('Add Adminuser'); ?></legend>
	<?php
		echo $this->Form->input('signumid');
		echo $this->Form->input('Description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Adminusers'), array('action' => 'index')); ?></li>
	</ul>
</div>
