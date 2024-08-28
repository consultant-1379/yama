<div class="adminusers form">
<?php echo $this->Form->create('Adminuser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ldap User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('signumid');
		echo $this->Form->input('Description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>	
        <ul>
		<li><?php echo $this->Html->link(__('View Ldap User'), array('action' => 'view', $this->Form->value('Adminuser.id'))); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ldap User'), array('action' => 'delete', $this->Form->value('Adminuser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Adminuser.id'))); ?> </li>
		<li><?php echo $this->Html->link(__('List Ldap Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ldap User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
